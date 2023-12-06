<?php

namespace App\Http\Controllers;

use App\Events\AdminChannel;
use App\Models\client_notification;
use App\Models\Element_de_panier;
use App\Models\Panier;
use App\Models\Reservation;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Monarobase\CountryList\CountryListFacade;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class ClientController extends Controller
{


    // public function __construct()
    // {
    //     $this->middleware('check.client');
    // }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->check()) {
            $userId = auth()->user()->id;
            $panierCount = Panier::where('user_id', $userId)->where('status', 'new')
                ->count();
            $cartItems = Panier::where('user_id', $userId)->where('status', 'new')->get();
            $subtotal = $cartItems->sum('montant_total');
        } else {
            $cartItems = [];
            $subtotal = 0;

            // Handle the case when the user is not authenticated
            $panierCount = 0; // or any other default value
        }
        $Service = DB::table('services')->get();
        $servicesByCategory = DB::table('services')
            ->orderBy('categories', 'asc')
            ->get()
            ->groupBy('categories');
        $countries = CountryListFacade::getList('en');
        return view("Frontoffice.home.index", compact('countries', 'Service', 'servicesByCategory', 'panierCount', 'cartItems', 'subtotal'));
    }


    //   button modifier mot de passe

    public function update_password(Request $request)
    {
        $current_user = auth()->user();

        // Check if the old password matches the current password
        if (!Hash::check($request->old_password, $current_user->password)) {
            return redirect()->back()
                ->withErrors([
                    'old_password' => 'Ancien mot de passe incorrect.',
                ])
                ->withInput();
        }

        // If the old password is correct, proceed with password update
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password'
        ]);

        $current_user->update([
            'password' => bcrypt($request->new_password)
        ]);

        // Set a success message
        session()->flash('passwordChangeSuccess', 'Mot de passe modifié avec succès.');

        return redirect()->back()->with('activeTab', 'v-pills-motdepasse-tab');
    }


    public function EditProfile(Request $request)
    {
        $id = $request['id'];
        $user = \App\Models\User::find($id);

        // Retrieve the user's existing image path
        $oldImagePath = $user->image;

        // Update the user's profile with the new data
        $user->name = $request['name'];
        $user->email = $request['email'];

        if ($request->hasFile('image')) {
            // Store the new image
            $newImagePath = $request->file('image')->store('uploads/users', 'public');

            // Update the user's image path with the new path
            $user->image = $newImagePath;

            // Delete the old image file (optional)
            if ($oldImagePath) {
                Storage::disk('public')->delete($oldImagePath);
            }
        }

        $user->numero = $request['numero'];
        $user->pays = $request['pays'];
        $user->genre = $request['genre'];
        $user->update();

        session()->flash('profilechanger', 'Profile modifié avec succès.');

        return redirect()->back();
    }
    public function getPanierEvents(Request $request)
    {
        // Get the service ID and user ID from the request
        $serviceId = $request->input('service_id');
        $userId = $request->input('user_id');

        $panierEvents = Panier::where('service_id', $serviceId)
            ->where(function ($query) {
                $query->whereHas('elementDePanier.reservation', function ($query) {
                    // Apply a condition on the related reservations
                    $query->where(function ($query) {
                        $query->where('etat_confirmation', 'confirmer')
                            ->orWhere('etat_confirmation', 'En attente')
                            ->orWhereNull('etat_confirmation'); // Include cases where etat_confirmation is null
                    });
                });
                // Or include records without related reservations
                $query->orWhereDoesntHave('elementDePanier.reservation');
            })
            ->with('service') // Load the related service data
            ->get();

        // Initialize an array to store the sum of 'nombre_de_place' for each start and end combination
        $sumsByStartEnd = [];

        // Prepare the events in the required format
        $events = [];

        foreach ($panierEvents as $panier) {
            $status = $panier->status; // Assuming you have a 'status' column in your Panier table

            // Get the start and end values from the current panier
            $currentStart = $panier->start;
            $currentEnd = $panier->end;

            // Calculate the sum for the current start and end combination
            $sumsByStartEndKey = "{$currentStart}_{$currentEnd}";
            $sumsByStartEnd[$sumsByStartEndKey] = ($sumsByStartEnd[$sumsByStartEndKey] ?? 0) + $panier->nombre_de_place;

            // The rest of your code remains the same...

            // Determine if the condition is met to show "Réservé" for the specific start and end dates
            if ($panier->service->methode_tarification == 'par_reservation') {
                $showReservedForAllUsers = $panier->service->capacite == 1 && $status === 'old';
            } else {
                $showReservedForAllUsers = $panier->service->capacite == $sumsByStartEnd[$sumsByStartEndKey] && $status === 'old';
            }
            if ($showReservedForAllUsers) {
                $title = 'Réservé'; // Show "Réservé" for all users
            } elseif ($panier->user_id == $userId) {
                $user = User::find($panier->user_id);
                $title = $user ? $user->name : 'Unknown User'; // Show the user's name for other events
            } else {
                continue; // Skip this event for other users if neither condition is met
            }

            $events[] = [
                'id' => $panier->id,
                'title' => $title,
                'start' => $currentStart,
                'end' => $currentEnd,
                'status' => $status,
                'nombreDePlaces' => $panier->nombre_de_place,
                'capacite' => $panier->service->capacite,
                'user_id' => $panier->user_id,
                'NomUser' => $title,
                'serviceTotalNombreDePlaces' => $sumsByStartEnd[$sumsByStartEndKey]
            ];
        }

        return response()->json($events);
    }



    public function showdetailsService($id)
    {
        $service = Service::find($id);

        if (!$service) {
            return redirect('/home');
        }

        $countries = CountryListFacade::getList('en');

        $ServicesSimilaire = Service::where('id', '!=', $id)->get();

        $userId = auth()->id();

        $cartItems = [];
        $subtotal = 0;
        $panierCount = 0;

        if (auth()->check()) {
            $cartItems = Panier::where('user_id', $userId)->where('status', 'new')->get();
            $subtotal = $cartItems->sum('montant_total');
            $panierCount = $cartItems->count();
        }

        return view('Frontoffice.services_details.index', [
            'excludedService' => $service,
            'services' => $service,
            'Service' => Service::all(),
            'countries' => $countries,
            'ServicesSimilaire' => $ServicesSimilaire,
            'panierCount' => $panierCount,
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
        ]);
    }



    // add to panier 
    public function addToPanier(Request $request)
    {

        $userId = $request->input('user_id');

        $requestedPlaces = $request->input('nombre_de_place');



        $serviceId = $request->input('service_id');






        $service = Service::find($serviceId);
        if (!$service) {
            return response()->json(['message' => 'Invalid service'], 400); // You can return an error response if the service doesn't exist
        }
        if ($requestedPlaces > $service->capacite) {
            // The requested number of places exceeds the capacity of the service
            return response()->json(['message' => 'Il n\'y a pas assez de places disponibles. Capacité du service: ' . $service->capacite], 400);
        }

        $start = Carbon::parse($request->input('start'));
        $end = Carbon::parse($request->input('end'));


        // Add one hour to both start and end times


        // Convert them back to the desired format (e.g., 'Y-m-d H:i:s')
        $startString = $start->toDateTimeString();
        $endString = $end->toDateTimeString();
        $montantTotal = $requestedPlaces * $service->prix;




        $totalDurationInHours = $start->diffInHours($end);

        // Calculate the remaining available places for the selected time range
        $reservationsInTimeRange = Panier::where('service_id', $serviceId)
            ->where('start', '<', $end)
            ->where('end', '>', $start)
            ->where(function ($query) {
                $query->whereHas('elementDePanier.reservation', function ($query) {
                    // Apply a condition on the related reservations
                    $query->where(function ($query) {
                        $query->where('etat_confirmation', 'confirmer')
                            ->orWhere('etat_confirmation', 'En attente')
                            ->orWhereNull('etat_confirmation'); // Include cases where etat_confirmation is null
                    });
                });
                // Or include records without related reservations
                $query->orWhereDoesntHave('elementDePanier.reservation');
            })
            ->sum('nombre_de_place');


        // $remainingCapacity calculation is not needed if you only want $reservationsInTimeRange


        $remainingCapacity = $service->capacite - $reservationsInTimeRange;

        if ($requestedPlaces > $remainingCapacity) {
            return response()->json(['message' => 'Pas assez de places disponibles dans la plage horaire sélectionnée. Capacité restante : ' . $remainingCapacity], 400);
        }

        $existingPanier1 = Panier::where('service_id', $serviceId)
            ->where('nombre_de_place', 1)
            ->where('start', '<', $end)
            ->where('end', '>', $start)
            ->where(function ($query) {
                $query->whereHas('elementDePanier.reservation', function ($query) {
                    // Apply a condition on the related reservations
                    $query->where(function ($query) {
                        $query->where('etat_confirmation', 'confirmer')
                            ->orWhere('etat_confirmation', 'En attente')
                            ->orWhereNull('etat_confirmation'); // Include cases where etat_confirmation is null
                    });
                });
                // Or include records without related reservations
                $query->orWhereDoesntHave('elementDePanier.reservation');
            })
            ->first();

        // Check if the panier is reserved
        if ($existingPanier1) {
            return response()->json(['message' => 'Ce service est déjà réservé.'], 400);
        }




        $existingPanier = Panier::where('user_id', $userId)
            ->where('service_id', $serviceId)
            ->whereDate('start', $start->format('Y-m-d'))
            ->whereDate('end', $end->format('Y-m-d'))
            ->where(function ($query) {
                $query->whereHas('elementDePanier.reservation', function ($query) {
                    // Apply a condition on the related reservations
                    $query->where(function ($query) {
                        $query->where('etat_confirmation', 'confirmer')
                            ->orWhere('etat_confirmation', 'En attente')
                            ->orWhereNull('etat_confirmation'); // Include cases where etat_confirmation is null
                    });
                });
                // Or include records without related reservations
                $query->orWhereDoesntHave('elementDePanier.reservation');
            })
            ->first();
        if ($existingPanier) {

            return response()->json(['message' => 'Vous avez déjà ajouté un service à votre panier pour la même journée.'], 400);
        }


        $panier = new Panier();
        $panier->service_id = $request->input('service_id');
        $panier->user_id = $request->input('user_id');


        $nombre_de_placeChildren = $request->input('nombre_de_placeChildren');
        $nombre_de_placeAdults = $request->input('nombre_de_placeAdults');

        if ($service->promotion == 1) {
            $panier->nombre_de_placeAdults =  $nombre_de_placeAdults;
            $panier->nombre_de_placeChildren =  $nombre_de_placeChildren;
        } else {
            $panier->nombre_de_placeAdults = null;
            $panier->nombre_de_placeChildren = null;
        }

        $panier->nombre_de_place = $request->input('nombre_de_place') ?? 1;


        if ($service->promotion == 0) {
            if ($request->input('nombre_de_place') === null) {
                $panier->montant_total = $service->prix;
            } else {
                // Calculate total based on the number of places and service price
                $panier->montant_total = $montantTotal; // Set montant_total

            }
        } else {
            if ($request->input('nombre_de_place')  > 2) {
                $panier->montant_total = $request->input('montant_total'); // Set montant_total

            } else {
                $panier->montant_total = $montantTotal; // Set montant_total

            }
        }


        $panier->start = $startString;
        $panier->end = $endString;
        $panier->save();
        $element = new Element_de_panier();
        $element->panier_id = $panier->id;
        // Set reservation_id to null initially, as you don't have a reservation ID at this point
        $element->reservation_id = null;
        $element->save();
        $panierId = $panier->id;

        $user = User::find($panier->user_id);
        $userName = $user ? $user->name : 'Unknown User';
        $eventData = [
            'id' => $panierId, // Add the panier ID to the eventData
            'title' => $userName, // Replace with the actual service title
            'start' => $startString,         // Use the $start variable
            'end' => $endString,
            'nombreDePlaces' => $panier->nombre_de_place, // Add the number of places to the extended properties
            'capacite' => $service->capacite, // Include the capacite property
            'NomUser'  => $userName,
            'extendedProps' => [
                'user_id' => $userId, // Include user_id in extendedProps
                // Other extended properties as needed
            ]
        ];
        return response()->json(['message' => 'Service added to panier successfully', 'event' => $eventData]);
    }

    public function getUpdatedCart()
    {
        $cartItems = [];
        $subtotal = 0;
        $panierCount = 0;

        if (auth()->check()) {
            $userId = auth()->user()->id;

            // Fetch cart items for the authenticated user with the related service model
            $cartItems = Panier::with('service')->where('user_id', $userId)->where('status', 'new')
                ->get();

            // Calculate the subtotal
            $subtotal = $cartItems->sum(function ($cartItem) {
                return $cartItem->montant_total;
            });

            // Count the items in the cart
            $panierCount = $cartItems->count();
        }

        return response()->json([
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'panierCount' => $panierCount,
        ])->header('Cache-Control', 'no-store');
    }

    public function deleteItem(Request $request, $id)
    {
        // Find the panier item by its ID
        $panierItem = Panier::find($id);

        if (!$panierItem) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Panier item not found.']);
            } else {
                return redirect()->back()->with('error', 'Panier item not found.');
            }
        }

        Element_de_panier::where('panier_id', $panierItem->id)->delete();

        // Delete the panier item
        $panierItem->delete();

        // Retrieve the authenticated user and their ID
        $user = Auth::user();
        $userId = $user->id;

        // Recalculate the subtotal after deleting the item
        $userCartItems = Panier::where('user_id', $userId)->get();
        $newSubtotal = $userCartItems->sum(function ($item) {
            return $item->nombre_de_place * $item->service->prix;
        });

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Service supprimé avec succès.', 'subtotal' => $newSubtotal, 'itemId' => $id]);
        } else {
            return redirect()->back()->with('Panier', 'Service supprimé avec succès.');
        }
    }



    public function deleteCartItem(Request $request)
    {
        $itemId = $request->input('item_id');

        // Delete the item from the Panier table
        $item = Panier::find($itemId);
        Element_de_panier::where('panier_id', $item->id)->delete();

        if ($item) {
            $item->delete();
            return response()->json(['message' => 'service retiré du panier.']);
        } else {
            return response()->json(['error' => 'Objet non-trouvé.']);
        }
    }


    public function fetchDatabaseNotifications()
    {
        $user = Auth::user();

        // Fetch all notifications, whether read or unread
        $notifications = client_notification::where('user_id', $user->id)->get();

        // Count the unread notifications
        $unreadCount = $notifications->where('read', false)->count();

        // Extract notification IDs from the notifications
        $notificationIds = $notifications->pluck('id');



        // Set the content type header to indicate JSON response
        header('Content-Type: application/json');

        return response()->json([
            'notifications' => $notifications,
            'unreadCount' => $unreadCount,
            'notificationIds' => $notificationIds,
        ]);
    }

    public function markAllRead()
    {
        $user = Auth::user();

        // Use a direct database query to mark all notifications as read for the authenticated user
        DB::table('client_notifications')
            ->where('user_id', $user->id)
            ->update(['read' => true]);

        return response()->json(['message' => 'Notifications marked as read']);
    }
    public function showreservations()
    {
        if (auth()->check()) {
            $userId = auth()->user()->id;
            $panierCount = Panier::where('user_id', $userId)->where('status', 'new')
                ->count();
            $cartItems = Panier::where('user_id', $userId)->where('status', 'new')->get();
            $subtotal = $cartItems->sum('montant_total');
            $reservations = Reservation::with(['elementDePanier.panier'])
                ->where('user_id', $userId)
                ->whereIn('etat_confirmation', ['refuser', 'confirmer'])
                ->get();
        } else {
            $cartItems = [];
            $subtotal = 0;
            $reservations = [];

            // Handle the case when the user is not authenticated
            $panierCount = 0; // or any other default value
        }
        $Service = Service::all();
        $countries = CountryListFacade::getList('en');
        $reservations = $reservations->sortByDesc('id'); // Sort reservations by ID in descending order

        return view('Frontoffice.reservations.index', compact('countries', 'Service', 'panierCount', 'cartItems', 'subtotal', 'reservations'));
    }
    public function deleteNotification($notificationId)
    {
        $notification = client_notification::find($notificationId);

        if (!$notification) {
            return response()->json(['success' => false]);
        }

        // Check if the notification belongs to the authenticated user
        if ($notification->user_id !== auth()->user()->id) {
            return response()->json(['success' => false]);
        }

        // Delete the notification
        $notification->delete();

        return response()->json(['success' => true]);
    }
    public function checkSlotAvailability(Request $request)
    {
        $start = $request->input('start');
        $end = $request->input('end');
        $serviceId = $request->input('service_id');

        // Add your logic to check availability based on nombre_de_place
        $isAvailable = $this->isSlotAvailable($start, $end, $serviceId);

        // Include start and end time in the response
        return response()->json([
            'is_available' => $isAvailable,
            'start' => $isAvailable ? $start : null,
            'end' => $isAvailable ? $end : null,
        ]);
    }

    private function isSlotAvailable($start, $end, $serviceId)
    {
        // Your logic to check availability in the database
        // You can use the sum of nombre_de_place for the specific service and compare it with the service capacity




        $overlappingSlots = Panier::where('service_id', $serviceId)
            ->where('start', '<', $end)
            ->where('end', '>', $start)
            ->where(function ($query) {
                $query->whereHas('elementDePanier.reservation', function ($query) {
                    // Apply a condition on the related reservations
                    $query->where(function ($query) {
                        $query->where('etat_confirmation', 'confirmer')
                            ->orWhere('etat_confirmation', 'En attente')
                            ->orWhereNull('etat_confirmation'); // Include cases where etat_confirmation is null
                    });
                });
                // Or include records without related reservations
                $query->orWhereDoesntHave('elementDePanier.reservation');
            })
            ->sum('nombre_de_place');





        $serviceCapacity = Service::find($serviceId)->capacite;

        return $overlappingSlots < $serviceCapacity;
    }
}

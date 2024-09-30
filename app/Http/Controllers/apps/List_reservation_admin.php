<?php

namespace App\Http\Controllers\apps;

use App\Http\Controllers\Controller;
use App\Models\Element_de_panier;
use App\Models\Panier;
use App\Models\Reservation;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResrvationEmail;

class List_reservation_admin extends Controller
{

     public function index()
    {
        $totalReservations = Reservation::count();
        $enAttenteCount = Reservation::where('etat_confirmation', 'En attente')->count();
        $confirmerCount = Reservation::where('etat_confirmation', 'confirmer')->count();
        $refuseCount = Reservation::where('etat_confirmation', 'refuser')->count();

        return view('content.apps.app-liste-reservation', compact('totalReservations', 'enAttenteCount', 'confirmerCount', 'refuseCount'));
    }

    public function getReservationData(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $startDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($endDate);

        $reservations = Reservation::whereHas('elementDePanier.panier', function ($query) use ($startDate, $endDate) {
            $query->whereDate('start', '<=', $endDate)
                ->whereDate('end', '>=', $startDate);
        })->with('user') // Eager load the user relationship
            ->get(); // Fetch the reservations

        $totalReservations = Element_de_panier::whereHas('panier', function ($query) use ($startDate, $endDate) {
            $query->whereDate('start', '<=', $endDate)
                ->whereDate('end', '>=', $startDate);
        })->distinct('reservation_id')->count();




        $enAttenteCount = Element_de_panier::whereHas('panier', function ($query) use ($startDate, $endDate) {
            $query->whereDate('start', '<=', $endDate)
                ->whereDate('end', '>=', $startDate);
        })->whereHas('reservation', function ($query) {
            $query->where('etat_confirmation', 'En attente');
        })->distinct('reservation_id')->count();


        $confirmerCount = Element_de_panier::whereHas('panier', function ($query) use ($startDate, $endDate) {
            $query->whereDate('start', '<=', $endDate)
                ->whereDate('end', '>=', $startDate);
        })->whereHas('reservation', function ($query) {
            $query->where('etat_confirmation', 'confirmer');
        })->distinct('reservation_id')->count();


        $refuseCount = Element_de_panier::whereHas('panier', function ($query) use ($startDate, $endDate) {
            $query->whereDate('start', '<=', $endDate)
                ->whereDate('end', '>=', $startDate);
        })->whereHas('reservation', function ($query) {
            $query->where('etat_confirmation', 'refuser');
        })->distinct('reservation_id')->count();

        return response()->json([

            'recordsTotal' => $totalReservations, // Add the total records
            'recordsFiltered' => $totalReservations, // You might want to use $totalReservations here for simplicity
            'totalReservations' => $totalReservations,
            'enAttenteCount' => $enAttenteCount,
            'confirmerCount' => $confirmerCount,
            'refuseCount' => $refuseCount,
            'reservations' => $reservations,

        ]);
    }





    public function getReservations(Request $request)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            if ($request->ajax()) {
                $query = Reservation::with('user'); // Eager load the user relationship

                // Count the total number of records before filtering
                $totalRecords = $query->count();

                if ($request->filled('search')) {
                    $searchValue = $request->input('search');
                    $query->where(function ($query) use ($searchValue) {
                        $query->where('etat_confirmation', 'like', "%$searchValue%")
                            ->orWhere('etat_paiement', 'like', "%$searchValue%")
                            ->orWhere('type_reservation', 'like', "%$searchValue%")
                            ->orWhereHas('user', function ($subquery) use ($searchValue) {
                                $subquery->where('name', 'like', "%$searchValue%");
                            });
                    });
                }

                // Count the number of records after filtering
                $filteredRecords = $query->count();

                // Handle pagination
                $start = $request->input('start', 0); // Initialize to 0
                $length = 10; // Always set length to 10

                $Reservations = $query
                    ->skip($start)
                    ->take($length)
                    ->get();

                $data = [];

                foreach ($Reservations as $reservation) {
                    $acceptButton = '';
                    $refuseButton = '';
                    $badgeClass = '';
                    $badgeClassPayment = '';
                    $paymentButton = '';
                    if ($reservation->etat_paiement === 'impayé') {
                        $badgeClassPayment = 'bg-label-danger'; // Red badge for "Impayé"
                        $paymentButton = '<button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#paymentModal-' . $reservation->id . '"><i class="fas fa-money-check"></i></button>';
                    } else if ($reservation->etat_paiement === 'payé') {
                        $badgeClassPayment = 'bg-label-success'; // Green badge for "Payé"
                    } else {
                        // Handle other cases (En attente, refuser, etc.)
                        // Set $badgeClassPayment to a default value or handle it based on your specific requirements.
                        $badgeClassPayment = 'bg-label-default'; // Change 'default' to your actual default value
                    }

                    if ($reservation->etat_confirmation === 'En attente' || $reservation->etat_confirmation === 'refuser') {
                        // Do not show paymentButton
                        $paymentButton = '';
                    }
                    if ($reservation->etat_confirmation === 'En attente') {
                        $badgeClass = 'bg-label-warning'; // Yellow badge for "En attente"
                    } elseif ($reservation->etat_confirmation === 'confirmer') {
                        $badgeClass = 'bg-label-success'; // Green badge for "confirmer"
                    } elseif ($reservation->etat_confirmation === 'refuser') {
                        $badgeClass = 'bg-label-danger'; // Red badge for "refuser"
                    }
                    if ($reservation->etat_confirmation === 'En attente') {
                        $acceptButton = '<button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#acceptModal-' . $reservation->id . '"><i class="fas fa-check"></i></button> ';
                        $refuseButton = '<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#refuseModal-' . $reservation->id . '"><i class="fas fa-times"></i></button>';
                    } else {
                    }
                    $data[] = [
                        'id' => $reservation->id,
                        'nom' =>  '<div class="d-flex justify-content-start align-items-center user-name">' .
                            ($reservation->user->image
                                ? '<div class="avatar me-3"><img src="/storage/' . $reservation->user->image . '" alt="Avatar" class="rounded-circle"></div>'
                                : '<div class="avatar me-3"><img src="https://ui-avatars.com/api/?name=' . urlencode($reservation->user->name) . '&background=104d93&color=fff" alt="Avatar" class="rounded-circle"></div>'
                            ) .
                            '<div class="d-flex flex-column"><a href="http://localhost:8000/app/user/view/account" class="text-body text-truncate"><span class="fw-medium">' . $reservation->user->name . '</span></a><small class="text-muted">' . $reservation->user->name . '</small></div></div>',

                        'etat confirmation' => '<span class="badge ' . $badgeClass . '" style="font-size: 16px;">' .
                            ($reservation->etat_confirmation == 'confirmer' ? 'Confirmé' : ($reservation->etat_confirmation == 'refuser' ? 'Refusé' : $reservation->etat_confirmation)) . '</span>',
                        'etat paiement' => '<span class="badge ' . $badgeClassPayment . '" style="font-size: 16px;">' . $reservation->etat_paiement . '</span>',

                        'type reservation' => '<i class="' . ($reservation->type_reservation === 'sur place' ? 'fas fa-map-marker-alt' : 'fas fa-globe') . '"></i> ' . $reservation->type_reservation,
                        'actions' => $acceptButton . $refuseButton . ' ' . $paymentButton . ' <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#calendarModal-' . $reservation->id . '"><i class="fas fa-calendar-alt"></i></button>
                        



                        <div class="modal fade" id="paymentModal-' . $reservation->id . '" tabindex="-1" aria-labelledby="paymentModalLabel-' . $reservation->id . '" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fs-5" id="paymentModalLabel-' . $reservation->id . '">Marquer le paiement</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Êtes-vous sûr de vouloir marquer le paiement pour la réservation ID: ' . $reservation->id . ' de ' . $reservation->user->name . ' ?
                                </div>
                                <div class="modal-footer">
                                    <form method="POST" action="/mark-payment/' . $reservation->id . '">
                                    ' . csrf_field() . '
                                                                            <button type="submit" class="btn btn-success"  style="margin-right: 10px;">Marquer Payé</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>






                        <div class="modal fade" id="acceptModal-' . $reservation->id . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title fs-5" id="deleteModalLabel">Confirmer l"acceptation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            Êtes-vous sûr de vouloir accepter cette réservation ID: ' . $reservation->id . ' de  ' . $reservation->user->name . ' ?
                            </div>
                            <div class="modal-footer">
                           
                            <form action="/accept-reservation/" method="POST">

                            ' . csrf_field() . '
                            <input type="hidden" name="reservation_id" value=" ' . $reservation->id . '">
                            <input type="hidden" name="id_user" value=" ' . $reservation->user->id . '">
                            <button type="submit" class="btn btn-success"  style="margin-right: 10px;">Accepter</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>

                        </form>
                            </div>
                        </div>
                        </div>

                    </div>
                <div class="modal fade" id="calendarModal-' . $reservation->id . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title fs-5" id="calendarModalLabel">Calendrier de réservation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <div id="calendar-' . $reservation->id . '" style="width: 100%; height: 100%;"></div>

                            </div>
                        </div>
                    </div>
                </div>
            
                   
                    <div class="modal fade" id="refuseModal-' . $reservation->id . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fs-5" id="deleteModalLabel">Refuser la réservation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        Êtes-vous sûr de vouloir refuser cette réservation ID: ' . $reservation->id . ' de ' . $reservation->user->name . ' ?
                        </div>
                        <div class="modal-footer">
                            <form action="/Refuser-reservation/" method="POST">

                            ' . csrf_field() . '
                            <input type="hidden" name="reservation_id" value=" ' . $reservation->id . '">
                            <input type="hidden" name="id_user" value=" ' . $reservation->user->id . '">
                            
                            <button type="submit" class="btn btn-danger"  style="margin-right: 10px;" >Refuser</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>

                        </form>
                        </div>
                        </div>
                    </div>

                    </div>
                        
                        ',

                    ];
                }

                $response = [
                    'data' => $data,
                    'recordsTotal' => $totalRecords,
                    'recordsFiltered' => $filteredRecords,
                ];
                return response()->json($response);
            } else {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        }
    }

    public function markPayment(Reservation $reservation)
    {
        try {
            // Add logic to update the payment status of the reservation
            $reservation->update(['etat_paiement' => 'payé']);

            $user = $reservation->user;
            $userEmail = $user->email;

            // Fetch related Element_de_panier instances using the reservation relationship
            $elementDePaniers = $reservation->elementDePanier;

            // Check if $elementDePaniers is not null before using map
            $selectedItems = [];
            if ($elementDePaniers) {
                // Use map to create an array of selected items
                $selectedItems = $elementDePaniers->map(function ($elementDePanier) {
                    $panier = $elementDePanier->panier;
                    $subtotal = $panier->nombre_de_place * $panier->service->prix;

                    return [
                        'id' => $panier->id,
                        'service_name' => $panier->service->Designations,
                        'image' => "/storage/{$panier->service->image}",
                        'imageEmail' => url("/storage/{$panier->service->image}"),
                        'nombre_de_place' => $panier->nombre_de_place,
                        'prix' => $panier->service->prix . ' TND',
                        'start' => $panier->start,
                        'end' => $panier->end,
                        'subtotal' => $subtotal,
                    ];
                });
            }

            // Send email using Mail::to() and queue()
            Mail::to($userEmail)->queue(new ResrvationEmail($user, $selectedItems, $reservation->id));

            return redirect()->back()->with('success', 'Le paiement a été marqué comme payé.');
        } catch (\Exception $e) {
            // Handle other exceptions
            return redirect()->back()->with('error', 'An unexpected error occurred.');
        }
    }

        public function markPaymentFilter(Request $request)
        {
            try {
                // Validate the request


                // Get the reservation ID from the request
                $reservationId = $request->input('reservation_id');
                // Fetch the Reservation model instance with the user relationship
                $reservation = Reservation::with('user')->findOrFail($reservationId);

                // Access user information
                $user = $reservation->user;
                $userEmail = $user->email;

                // Fetch related Element_de_panier instances using the reservation relationship
                $elementDePaniers = $reservation->elementDePanier;

                // Use map to create an array of selected items
                $selectedItems = $elementDePaniers->map(function ($elementDePanier) {
                    $panier = $elementDePanier->panier;
                    $subtotal = $panier->nombre_de_place * $panier->service->prix;

                    return [
                        'id' => $panier->id,
                        'service_name' => $panier->service->Designations,
                        'image' => "/storage/{$panier->service->image}",
                        'imageEmail' => url("/storage/{$panier->service->image}"),
                        'nombre_de_place' => $panier->nombre_de_place,
                        'prix' => $panier->service->prix . ' TND',
                        'start' => $panier->start,
                        'end' => $panier->end,
                        'subtotal' => $subtotal,
                    ];
                });

                // Send email using Mail::to() and queue()
                Mail::to($userEmail)->queue(new ResrvationEmail($user, $selectedItems, $reservationId));

                // Perform your logic to mark the reservation as paid
                $reservation->update(['etat_paiement' => 'payé']);

                // Redirect back or return a response as needed
                return redirect()->back()->with('success', 'Reservation marked as paid successfully');
            } catch (ModelNotFoundException $e) {
                dd('An unexpected error occurred: ' . $e->getMessage());

                // Handle the case where the Reservation model is not found
                return redirect()->back()->with('error', 'Reservation not found.');
            } catch (\Exception $e) {
                // Handle other exceptions (e.g., mail sending failure)
                // Log the error for further investigation
                // \Log::error('Error in markPaymentFilter: ' . $e->getMessage());
                return redirect()->back()->with('error', 'An unexpected error occurred.');
            }
        }
    public function getPanierEvents($reservationId)
    {
        // Assuming you have a Reservation model and a Panier model

        // Fetch all element_de_panier records with the given reservation_id
        $elementDePaniers = Element_de_panier::where('reservation_id', $reservationId)->get();

        // Prepare the events in the required format
        $events = [];

        foreach ($elementDePaniers as $element) {
            $panier = $element->panier; // Access the panier associated with this element_de_panier
            $user = $panier->user; // Access the user associated with this panier

            // You can use the actual service title here
            $service = Service::find($panier->service_id);
            $serviceName = $service ? $service->Designations : 'Service Inconnu';

            // Get the reservation status
            $reservation = Reservation::find($element->reservation_id);
            $etatConfirmation = $reservation ? $reservation->etat_confirmation : 'En attente';

            // Include the reservation ID in the event data
            $events[] = [
                'title' =>  $serviceName . " - " . $panier->nombre_de_place . " places (État: " . $etatConfirmation . ")",
                'start' => $panier->start,
                'end' => $panier->end,
            ];
        }

        return response()->json($events);
    }
}

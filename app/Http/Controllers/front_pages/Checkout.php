<?php

namespace App\Http\Controllers\front_pages;

use App\Events\AdminChannel;
use App\Http\Controllers\Controller;
use App\Mail\ResrvationEmail;
use App\Models\notification;
use App\Models\Panier;
use App\Models\Reservation;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Monarobase\CountryList\CountryListFacade;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class Checkout extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $countries = CountryListFacade::getList('en');
    $Service = Service::all();
    if (auth()->check()) {
      $userId = auth()->user()->id;
      $totalWithoutPromotion = Panier::where('user_id', $userId)
        ->where('status', 'new')
        ->join('services', 'paniers.service_id', '=', 'services.id')
        ->sum(DB::raw('nombre_de_place * services.prix'));

      $panierCount = Panier::where('user_id', $userId)->where('status', 'new')->count();
      $cartItems = Panier::where('user_id', $userId)->where('status', 'new')->get();
      $subtotal = $cartItems->sum('montant_total');
    } else {
      $cartItems = [];
      $subtotal = 0;
      $totalWithoutPromotion = 0;

      // Handle the case when the user is not authenticated
      $panierCount = 0;  // or any other default value
    }
    $pageConfigs = ['myLayout' => 'front'];
    return view('Frontoffice.checkout.index', ['pageConfigs' => $pageConfigs])->with('totalWithoutPromotion', $totalWithoutPromotion)->with('countries', $countries)->with('Service', $Service)->with('panierCount', $panierCount)->with('cartItems', $cartItems)->with('subtotal', $subtotal);
  }

  public function updateCartItemQuantity(Request $request)
  {
    $itemId = $request->input('item_id');
    $newQuantity = $request->input('new_quantity');


    $adultsValue = $request->input('adultsValue');
    $childrenValue = $request->input('childrenValue');


    // Find the cart item by ID
    $cartItem = Panier::find($itemId);

    if (!$cartItem) {
      return response()->json(['success' => false, 'message' => 'Cart item not found']);
    }

    $service = Service::find($cartItem->service_id);

    // Calculate the total reservations for this service with the same start and end times
    $totalReservations = Panier::where('service_id', $service->id)
      ->where('start', $cartItem->start)
      ->where('end', $cartItem->end)
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

    $remainingCapacity = $service->capacite - $totalReservations;

    if ($newQuantity < $cartItem->nombre_de_place) {
      // Allow the update since the user is reducing their reservation
    } elseif ($remainingCapacity < 1) {
      return response()->json(['message' => 'Toutes les places sont déjà réservées pour ce service.'], 400);
    } elseif ($newQuantity > $cartItem->nombre_de_place) {
      // Allow increasing the quantity, but still check against the remaining capacity
      if ($newQuantity > $service->capacite) {
        return response()->json(['success' => false, 'message' => 'Quantité demandée supérieure à la capacité du service (' . $service->capacite . ' places)'], 400);
      }
    }

    $service = Service::find($cartItem->service_id);
    // Update the quantity and save to the database
    $cartItem->nombre_de_place = $newQuantity;
    $cartItem->nombre_de_placeAdults = $adultsValue;
    $cartItem->nombre_de_placeChildren = $childrenValue;


    if ($service->promotion == 1 && $newQuantity > 2) {
      // Apply the formula for calculating montant_total with promotion
      $cartItem->montant_total = 2 * $cartItem->service->prix + ($adultsValue - 2) * 10 + $childrenValue * 5;
    } else {
      // Calculate the montant_total without promotion
      $cartItem->montant_total = $newQuantity * $cartItem->service->prix;
    }
    $cartItem->save();


    $totalWithoutPromotion = Panier::where('user_id', auth()->id())
      ->where('status', 'new')
      ->join('services', 'paniers.service_id', '=', 'services.id')
      ->sum(DB::raw('nombre_de_place * services.prix'));
    // Calculate the new total and return it in the response
    $totalPromotion = Panier::where('user_id', auth()->id())
      ->where('status', 'new')
      ->sum('montant_total');
    return response()->json(['success' => true, 'total' => $totalPromotion, 'totalWithoutPromotion' => $totalWithoutPromotion, 'newQuantity' => $newQuantity]);
  }

  public function updateProfilecheckout(Request $request)
  {
    try {
      $idUser = $request->input('idUser');
      $name = $request->input('name');
      $numero = $request->input('numero');
      $pays = $request->input('pays');
      $genre = $request->input('genre');

      $user = User::find($idUser);

      if (!$user) {
        return response()->json(['message' => 'Utilisateur non trouvé.'], 404);
      }

      $user->name = $name;
      $user->numero = $numero;
      $user->pays = $pays;
      $user->genre = $genre;
      $user->save();

      // Update the user's profile with the new data

      return response()->json(['message' => 'Mise à jour du profil réussie'], 200);
    } catch (\Exception $e) {
      // Log the exception for debugging purposes
      // \Log::error('Update Profile Error: ' . $e->getMessage());

      return response()->json(['message' => $e->getMessage()], 500);
    }
  }

  public function initiatePayment($subtotalAmount)
  {


    // Assuming $reservation is your reservation instance
    $user = auth()->user();  // Get the authenticated user




    $orderId = Str::uuid()->toString();
    // Construct the API request body
    $paymentData = [
      'receiverWalletId' => '654ba035b05655f8fdb5ab1b',
      'token' => 'TND',
      'amount' => $subtotalAmount,  // Assuming subtotal is calculated somewhere in your code
      'type' => 'immediate',
      'acceptedPaymentMethods' => ['wallet', 'bank_card', 'e-DINAR'],
      'lifespan' => 10,
      'checkoutForm' => false,
      'addPaymentFeesToAmount' => true,
      'firstName' => $user->name,  // Dynamically set from the user's data
      'phoneNumber' => $user->numero,  // Dynamically set from the user's data
      'email' => $user->email,  // Dynamically set from the user's data
      'orderId' =>  $orderId,
      'webhook' => 'https://merchant.tech/api/notification_payment',
      'silentWebhook' => true,
      'successUrl' => str_replace('http://127.0.0.1:8000', 'http://127.0.0.1:8000', url('/payment-success')),
      'failUrl' => str_replace('http://127.0.0.1:8000', 'http://127.0.0.1:8000', url('/payment-failure')),
      'theme' => 'light',
    ];

    // Make the API request
    $response = Http::withHeaders([
      'x-api-key' => '654ba035b05655f8fdb5ab17:s376xJ975g2we6cxqaPSER5ZAmzP',
    ])->asJson()->post('https://api.konnect.network/api/v2/payments/init-payment', $paymentData);

    // Check if the API request was successful
    if ($response->successful()) {
      $responseData = $response->json();

      // Extract necessary information from the response
      $payUrl = $responseData['payUrl'];
      $paymentRef = $responseData['paymentRef'];

      // Open the payment URL in the browser
      return redirect()->away($payUrl);
    } else {
      // Handle the case where the API request was not successful
      return response()->json(['error' => 'Failed to initiate payment'], $response->status());
    }
  }

  public function confirmReservation(Request $request)
  {
    // Assuming you have the authenticated user
    $user = auth()->user();
    $reservation = new Reservation();
    $newPaniers = $user->paniers->where('status', 'new');
    $selectedItems = [];
    $reservationId = null;

    if ($newPaniers->isNotEmpty()) {
      // Start a database transaction
      DB::beginTransaction();

      try {
        // Create a new reservation for the user

        $typeReservation = $request->input('selectedPaymentMethod') === 'credit-card' ? 'en ligne' : 'sur place';

        // Set the default values

        // Get the ID of the newly created reservation


        // Call the initiatePayment method only if the selected payment method is 'credit-card'


        $reservation->user_id = $user->id;
        $reservation->type_reservation = $typeReservation;
        $reservation->etat_confirmation = 'En attente';
        $reservation->etat_paiement = 'impayé';
        $reservation->save();

        $reservationId = $reservation->id;

        $newPaniers->each(function ($panier) use ($reservationId, &$selectedItems) {
          $panier->status = 'old';
          $panier->update();

          $panier->reservations->each(function ($element) use ($reservationId) {
            $element->reservation_id = $reservationId;
            $element->update();
          });

          $subtotal = $panier->nombre_de_place * $panier->service->prix;

          $selectedItems[] = [
            'id' => $panier->id,
            'service_name' => $panier->service->Designations,
            'image' => "/storage/{$panier->service->image}",
            'imageEmail' => url("/storage/{$panier->service->image}"),
            'nombre_de_place' => $panier->nombre_de_place,
            'prix' => $panier->service->prix . ' TND',
            'start' => $panier->start,
            'end' => $panier->end,
            'subtotal' => $subtotal,  // Calculate and include subtotal
          ];
        });

        $reservation->user()->associate($user);

        $dataToBroadcast = [
          'reservation' => $reservation,
        ];

        try {
          // Save the dataToBroadcast into the notifications table
          $notification = new Notification();
          $notification->reservation_id = $reservationId;
          $notification->data_to_broadcast = json_encode($dataToBroadcast);
          $notification->save();

          // Now, update the $dataToBroadcast array to include the notification_id
          $dataToBroadcast = [
            'reservation' => $reservation,
            'notification_id' => $notification->id,  // Add this line
            'created_at' => $notification->created_at->toIso8601String(),  // Convert to ISO 8601 format
          ];

          event(new AdminChannel($dataToBroadcast));
        } catch (\Exception $e) {
          // Handle any exceptions
          // ...
          return response()->json(['message' => 'An error occurred while saving the notification.'], 500);
        }

        // Check if the payment initiation was successful

        // ... The rest of your existing code ...

        // Commit the transaction if everything was successful
        DB::commit();

        // Mail::to($user->email)->queue(new ResrvationEmail($user, $selectedItems, $reservationId));
      } catch (\Exception $e) {
        // Something went wrong, so rollback the transaction
        DB::rollBack();
        $errorMessage = $e->getMessage();  // Capture the specific exception message

        // Log the error message

        return response()->json(['message' => $errorMessage], 500);
      }

      return response()->json([
        'message' => 'Réservation confirmée avec succès',
        'selectedItems' => $selectedItems,
        'reservationId' => $reservationId,
      ]);
    } else {
      return response()->json(['message' => "L'utilisateur n'a pas de nouveaux paniers"], 400);
    }
  }

  public function fetchNotifications()
  {
    try {
      // Fetch notifications from the database or any other source
      $notifications = Notification::all();  // Adjust this based on your database model

      return response()->json([
        'notifications' => $notifications,
        'unreadCount' => $notifications->where('read', false)->count(),
      ]);
    } catch (\Exception $e) {
      // Log the exception for debugging purposes

      return response()->json(['error' => 'Internal Server Error'], 500);
    }
  }
}

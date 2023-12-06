<?php

namespace App\Http\Controllers\apps;

use App\Events\PrivateChannelUser;
use App\Http\Controllers\Controller;
use App\Mail\ResrvationEmail;
use App\Models\client_notification;
use App\Models\ClientNotification;
use App\Models\Element_de_panier;
use App\Models\Panier;
use App\Models\Reservation;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Calendar extends Controller
{
  public function index()
  {
    return view('content.apps.app-calendar');
  }

  public function getServicesInPanierMonth($startOfMonth, $endOfMonth)
  {
    $startDate = Carbon::parse($startOfMonth);
    $endDate = Carbon::parse($endOfMonth);
    $dates = [];

    while ($startDate <= $endDate) {
      $formattedDate = $startDate->toDateString();

      $count = Element_de_panier::whereHas('panier', function ($query) use ($formattedDate) {
        $query
          ->whereDate('start', '<=', $formattedDate)
          ->whereDate('end', '>=', $formattedDate);
      })->whereNotNull('reservation_id')->count();

      $dates[] = [
        'date' => $formattedDate,
        'count' => $count,
      ];

      $startDate->addDay();
    }

    return response()->json(['dates' => $dates]);
  }

  public function getPanierEvents(Request $request)
  {
    // Fetch all element_de_panier records with a reservation_id
    $elementDePaniers = Element_de_panier::whereNotNull('reservation_id')->get();

    // Prepare the events in the required format
    $events = [];

    foreach ($elementDePaniers as $element) {
      $panier = $element->panier;  // Access the panier associated with this element_de_panier
      $user = $panier->user;  // Access the user associated with this panier

      // You can use the actual service title here
      $service = Service::find($panier->service_id);
      $serviceName = $service ? $service->Designations : 'Service Inconnu';

      // Get the reservation status
      $reservation = Reservation::find($element->reservation_id);
      $etatConfirmation = $reservation ? $reservation->etat_confirmation : 'En attente';

      // Include the reservation ID in the event data
      $events[] = [
        'title' => $user->name . ' : ' . $serviceName . ' - ' . $panier->nombre_de_place . ' places',
        'start' => $panier->start,
        'end' => $panier->end,
        'reservation_id' => $element->reservation_id,  // Include the reservation ID
        'etat_confirmation' => $etatConfirmation,
        'id_user' => $user->id  // Include the reservation status
      ];
    }

    return response()->json($events);
  }

  public function acceptReservation(Request $request)
  {
    $selectedItems = [];
    $reservationId = $request->input('reservation_id');
    $id_user = $request->input('id_user');
    $user = User::find($id_user);  // Fetch the user based on the ID

    $reservation = Reservation::find($reservationId);

    // Check if the reservation is in 'En attente' status
    if ($reservation->etat_confirmation === 'En attente') {
      $reservation->etat_confirmation = 'confirmer';
      $reservation->save();

      // Fetch relevant Element_de_panier items for this reservation
      $elementDePaniers = Element_de_panier::where('reservation_id', $reservationId)->get();

      foreach ($elementDePaniers as $elementDePanier) {
        $panier = $elementDePanier->panier;
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
      }

      Mail::to($user->email)->queue(new ResrvationEmail($user, $selectedItems, $reservationId));
      $message = "Votre réservation (ID : {$reservation->id}) a été confirmée avec succès.";

      // Send a notification to the user
      $created_at = now()->format('Y-m-d H:i:s');

      event(new PrivateChannelUser($message, $id_user, $created_at));

      client_notification::create([
        'user_id' => $id_user,
        'message' => $message,
        'created_at' => $created_at, // Save the timestamp in the database
      ]);

      return redirect()->back()->with('success', 'réservation acceptée.');
    }
    return redirect()->back()->with('failed', "Impossible d'accepter la réservation.");
  }

  public function RefuserReservation(Request $request)
  {
    $selectedItems = [];

    $reservationId = $request->input('reservation_id');
    $id_user = $request->input('id_user');
    $user = User::find($id_user);  // Fetch the user based on the ID


    $reservation = Reservation::find($reservationId);

    // Check if the reservation is in 'En attente' status
    if ($reservation->etat_confirmation === 'En attente') {

      $reservation->etat_confirmation = 'refuser';
      $reservation->save();

      // Retrieve all element_de_panier records for this reservation
      $elementDePaniers = Element_de_panier::where('reservation_id', $reservationId)->get();

      foreach ($elementDePaniers as $elementDePanier) {
        $panier = $elementDePanier->panier;
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
      }
      Mail::to($user->email)->queue(new ResrvationEmail($user, $selectedItems, $reservationId));
      
      // Initialize a message to hold the panier details
      $message = "Votre réservation (ID : {$reservation->id}) a été refusée.";

      // Send a notification to the user
      // Assume $created_at contains the timestamp you want to send
      $created_at = now()->format('Y-m-d H:i:s');

      event(new PrivateChannelUser($message, $id_user, $created_at));

      client_notification::create([
        'user_id' => $id_user,
        'message' => $message,
        'created_at' => $created_at, // Save the timestamp in the database
      ]);


      return redirect()->back()->with('success', 'Réservation refusée.');
    }

    return redirect()->back()->with('failed', "Impossible d'accepter la réservation.");
  }
}

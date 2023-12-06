<?php

namespace App\Http\Controllers;


use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Reservation;
use App\Models\Element_de_panier;

class QRCodeController extends Controller
{

  public function generateQRCode($data)
  {
    // Add the base URL to the data
    $baseURL = 'http://test.hammamboulaaba.com/';
    $dataWithBaseURL = $baseURL . $data;

    // Decode the data from the URL
    $decodedData = urldecode($dataWithBaseURL);

    // Generate the QR code with the cleaned data
    $qrCode = QrCode::format('png')
      ->size(300)
      ->color(39, 52, 127)
      ->merge(public_path('icone-01.png'), 0.12, true)
      ->errorCorrection('H')
      ->generate($decodedData);

    return response($qrCode)->header('Content-Type', 'image/png');
  }



  public function decodeQRCode($dataFromQRCode)
  {
    // Decode the URL-encoded data from the QR code
    $decodedData = urldecode($dataFromQRCode);

    // Now $decodedData contains the original data
    return $decodedData;
  }


  public function showQRCode($reservationId)
  {
    // Retrieve the reservation by ID
    $reservation = Reservation::findOrFail($reservationId);

    // Check if the reservation has a valid etat_confirmation
    if ($reservation->etat_confirmation !== 'confirmer' && $reservation->etat_confirmation !== 'refuser') {
      // You may want to handle this case, perhaps redirecting or displaying an error message
      abort(404, 'Réservation non confirmée ou rejetée');
    }

    // Retrieve the user associated with the reservation
    $user = $reservation->user;

    // Retrieve all element_de_panier records for this reservation
    $elementDePaniers = Element_de_panier::where('reservation_id', $reservationId)->get();

    $selectedItems = [];

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

    // Pass the $user, $selectedItems, and other necessary data to the view
    return view('email.codeqr', ['user' => $user, 'selectedItems' => $selectedItems, 'reservation' => $reservation]);
  }
}

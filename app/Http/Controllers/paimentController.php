<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Reservation;
use App\Models\notification;
use App\Events\AdminChannel;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResrvationEmail;

use Illuminate\Http\Request;

class paimentController extends Controller
{
    public function paymentSuccess()
    {
        // Add logic for successful payment
        $user = auth()->user();  // Get the authenticated user

        $reservation = new Reservation();
        $newPaniers = $user->paniers->where('status', 'new');
        $selectedItems = [];
        $reservationId = null;
        if ($newPaniers->isNotEmpty()) {
            // Start a database transaction
            DB::beginTransaction();

            try {
                // Create a new reservation for the user

                $typeReservation = 'en ligne';

                // Set the default values

                // Get the ID of the newly created reservation


                // Call the initiatePayment method only if the selected payment method is 'credit-card'


                $reservation->user_id = $user->id;
                $reservation->type_reservation = $typeReservation;
                $reservation->etat_confirmation = 'confirmer';
                $reservation->etat_paiement = 'payé';
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

                Mail::to($user->email)->queue(new ResrvationEmail($user, $selectedItems, $reservationId));
            } catch (\Exception $e) {
                // Something went wrong, so rollback the transaction
                DB::rollBack();
                $errorMessage = $e->getMessage();  // Capture the specific exception message

                // Log the error message

                return response()->json(['message' => $errorMessage], 500);
            }

           
          
                // If not, return a redirect response
                // if (session('success') || session('selectedItems') || session('reservationId')) {
                //     // Remove the session data
                //     session()->forget(['success', 'selectedItems', 'reservationId']);
                // }
            


                return redirect()->route('front-pages-checkout', [
                    'selectedItems' => $selectedItems,
                    'reservationId' => $reservationId,
                    
                ])->with('success', 'Votre paiement est réussi.');            
        }
    }

    public function paymentFailure()
    {
        // Add logic for failed payment
        return redirect()->route('front-pages-checkout')->with('error', 'Votre paiement a échoué.');
    }
}

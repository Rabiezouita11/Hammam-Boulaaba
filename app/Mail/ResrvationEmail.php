<?php

namespace App\Mail;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResrvationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $selectedItems;
    public $reservationId;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, $selectedItems, $reservationId)
    {
        $this->user = $user;
        $this->selectedItems = $selectedItems;
        $this->reservationId = $reservationId;
    }

    public function build()
    {
        $reservation = Reservation::find($this->reservationId);
        $subject = '';

        if ($reservation->etat_confirmation === 'confirmer') {
            if ($reservation->etat_paiement === 'payé') {
                $subject = 'Confirmation de votre réservation (paiement effectué) chez Hammam Boulaaba';
            } else {
                $subject = 'Confirmation de votre réservation chez Hammam Boulaaba';
            }
        } elseif ($reservation->etat_confirmation === 'refuser') {
            $subject = 'Information sur la réservation chez Hammam Boulaaba';
        }

        $greeting = '';

        if ($reservation->etat_confirmation === 'confirmer') {
            $greeting = 'Votre réservation a été confirmée avec succès. Nous vous remercions de choisir Hammam Boulaaba et sommes ravis de vous accueillir.';
        } elseif ($reservation->etat_confirmation === 'refuser') {
            $greeting = 'Nous regrettons de vous informer que votre réservation a été refusée. Nous vous remercions pour votre intérêt envers Hammam Boulaaba.';
        }

        $professionalMessage = '';

        if ($reservation->etat_paiement === 'payé') {
            $professionalMessage = 'Nous vous remercions d\'avoir effectué le paiement pour votre réservation. Votre engagement est très apprécié.';
        }

        return $this
            ->subject($subject)
            ->view('email.reservation')
            ->with([
                'greeting' => $greeting,
                'user' => $this->user,
                'selectedItems' => $this->selectedItems,
                'reservationId' => $this->reservationId,
                'professionalMessage' => $professionalMessage,
                'reservation' => $reservation, // Add this line

            ]);
    }
}

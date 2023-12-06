<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User; // Make sure to import the User model

class UserRegistered extends Mailable
{
    use Queueable, SerializesModels;

    public $user; // This variable will be accessible in the email view

    /**
     * Create a new message instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this
            ->subject('Bienvenue chez Hammam Boulaaba')
            
            ->view('email.email'); // Use the Blade view you created for the email content
            

    }
}

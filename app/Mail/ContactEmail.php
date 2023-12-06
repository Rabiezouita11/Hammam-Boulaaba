<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $subject;
    public $messages;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $email, $subject, $messages)
    {
        $this->name = $name;
        $this->email = $email;
        $this->subject = $subject;
        $this->messages = $messages;
    }

    public function build()
    {
        return $this
            ->subject($this->subject) // Set the email subject
            ->view('email.contact'); // Use a Blade view for the contact email
    }
}

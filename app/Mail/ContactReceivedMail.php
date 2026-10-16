<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactReceivedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Contact $contact
    ) {
    }

    public function build(): static
    {
        return $this
            ->subject('New Contact Request - Houida Consulting')
            ->view('emails.contact-received');
    }
}
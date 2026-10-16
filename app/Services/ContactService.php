<?php

namespace App\Services;

use App\Mail\ContactReceivedMail;
use App\Models\Contact;
use App\Repositories\Contracts\ContactRepositoryInterface;
use Illuminate\Support\Facades\Mail;

class ContactService
{
    public function __construct(
        protected ContactRepositoryInterface $contactRepository
    ) {
    }

    public function create(array $data): Contact
    {
        $contact = $this->contactRepository->create($data);

        Mail::to(config('mail.contact_email'))
            ->send(new ContactReceivedMail($contact));

        return $contact;
    }
}
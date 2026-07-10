<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerRegisteredAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $customer;

    public function __construct(User $customer)
    {
        $this->customer = $customer;
    }

    public function build()
    {
        return $this->subject('New customer registration pending verification')
            ->view('emails.admin.customer-registered')
            ->with([
                'customer' => $this->customer,
            ]);
    }
}

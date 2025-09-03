<?php

namespace App\Mail;

use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $customer;
    public $tries = 3;
    public $timeout = 300;
    public $backoff = [60,120,300];

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function build()
    {
        return $this->subject('Welcome to Our Service')
                    ->markdown('emails.customers.welcome')
                    ->with([
                        'name' => $this->customer->name,
                    ]);
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderRecieved extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $products;
    public $customer;
    public $currency;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $products, $customer, $currency)
    {
        $this->order = $order;
        $this->products = $products;
        $this->customer = $customer;
        $this->currency = $currency;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@example.com')->view('emails.order-recieved')
        ->subject('Order has been Recieved');
    }
}

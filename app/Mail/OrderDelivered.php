<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderDelivered extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $msg,$products, $customer, $currency)
    {
        $this->msg = $msg;
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
        return $this->from('info@example.com')->view('emails.order-delivered')
        ->subject('Your Order has been Delivered');
    }
}

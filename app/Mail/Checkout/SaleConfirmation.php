<?php

namespace App\Mail\Checkout;

use App\Sale;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SaleConfirmation extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var Sale
     */
    private $sale;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Sale $sale)
    {
    
        $this->sale = $sale;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $sale = $this->sale;
        return $this
            ->subject('Your purchase confirmation')
            ->view('emails.checkout.confirmation', compact('sale'));
    }
}

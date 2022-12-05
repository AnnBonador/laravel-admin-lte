<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailInvoice extends Mailable
{
    use Queueable, SerializesModels;
    public $invoice_no;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invoice_no)
    {
        $this->invoice_no = $invoice_no;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Your Payment Receipt";
        return $this->subject($subject)
            ->view('user.appointment.invoice');
    }
}

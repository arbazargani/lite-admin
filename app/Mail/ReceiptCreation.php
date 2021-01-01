<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Receipt;
use App\User;

class ReceiptCreation extends Mailable
{
    use Queueable, SerializesModels;

    public $receipt;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Receipt $receipt, User $user)
    {
        $this->receipt = $receipt;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('operator@cryptiner.com')
                    ->view('emails.ReceiptCreation');
    }
}

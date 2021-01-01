<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Mail;
use App\Mail\ReceiptCreation;

use App\Receipt;
use App\User;

class SendReceiptCreationMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $receipt;
    public $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Receipt $receipt, User $user)
    {
        $this->receipt = $receipt->withoutRelations();
        $this->user = $user->withoutRelations();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new ReceiptCreation($this->receipt, $this->user);
        Mail::to($this->user->email)->send($email);
    }
}

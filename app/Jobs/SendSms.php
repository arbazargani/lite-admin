<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Http\Controllers\UserController;

class SendSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $information;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($information)
    {
        $this->information = $information;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $handle = new UserController();
        $handle->SendRegistrationSms($this->information);
    }
}

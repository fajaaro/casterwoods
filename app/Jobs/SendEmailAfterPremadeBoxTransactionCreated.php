<?php

namespace App\Jobs;

use App\Mail\NewPremadeBoxTransaction;
use App\Mail\PremadeTransactionAdded;
use App\PremadeTransaction;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailAfterPremadeBoxTransactionCreated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $premadeTransaction;

    public function __construct(PremadeTransaction $premadeTransaction)
    {
        $this->premadeTransaction = $premadeTransaction;
    }

    public function handle()
    {
        $adminUsers = User::where('is_admin', 1)->get();

        foreach ($adminUsers as $admin) {
            Mail::to($admin)->send(new PremadeTransactionAdded($this->premadeTransaction, $admin));
        }
    }
}

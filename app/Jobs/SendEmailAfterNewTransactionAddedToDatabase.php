<?php

namespace App\Jobs;

use App\Mail\NewTransaction;
use App\Mail\TransactionAdded;
use App\Transaction;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailAfterNewTransactionAddedToDatabase implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function handle()
    {
        $adminUsers = User::where('is_admin', 1)->get();

        foreach ($adminUsers as $admin) {
            Mail::to($admin)->send(new TransactionAdded($this->transaction, $admin));
        }
    }
}

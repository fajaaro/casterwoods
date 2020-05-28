<?php

namespace App\Mail;

use App\Transaction;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TransactionAdded extends Mailable
{
    use Queueable, SerializesModels;

    public $transaction;
    public $user;

    public function __construct(Transaction $transaction, User $user)
    {
        $this->transaction = $transaction;
        $this->user = $user;
    }

    public function build()
    {
        return $this->markdown('emails.transactionAdded');
    }
}

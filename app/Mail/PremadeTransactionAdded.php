<?php

namespace App\Mail;

use App\PremadeTransaction;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PremadeTransactionAdded extends Mailable
{
    use Queueable, SerializesModels;

    public $premadeTransaction;
    public $user;

    public function __construct(PremadeTransaction $premadeTransaction, User $user)
    {
        $this->premadeTransaction = $premadeTransaction;
        $this->user = $user;
    }

    public function build()
    {
        return $this->markdown('emails.premadeTransactionAdded');
    }
}

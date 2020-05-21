<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    public $timestamps = false;

    public function transactions()
    {
    	return $this->hasMany('App\Transaction');
    }

    public function premadeTransactions()
    {
    	return $this->hasMany('App\PremadeTransaction');
    }
}

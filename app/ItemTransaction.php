<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemTransaction extends Model
{
    public $timestamps = false;

    public function item()
    {
    	return $this->belongsTo('App\Item');
    }

    public function transaction()
    {
    	return $this->belongsTo('App\Transaction');
    }
}

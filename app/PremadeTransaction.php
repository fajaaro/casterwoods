<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PremadeTransaction extends Model
{
    public function courier()
    {
    	return $this->belongsTo('App\Courier');
    }

    public function premadeBox()
    {
    	return $this->belongsTo('App\PremadeBox');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}

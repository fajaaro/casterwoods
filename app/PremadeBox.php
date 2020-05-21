<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PremadeBox extends Model
{
    public function premadeBoxCategory()
    {
    	return $this->belongsTo('App\PremadeBoxCategory');
    }

    public function images()
    {
    	return $this->morphMany('App\Image', 'imageable');
    }

    public function premadeTransactions()
    {
    	return $this->hasMany('App\PremadeTransaction');
    }
}

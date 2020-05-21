<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PremadeBoxCategory extends Model
{
    public $timestamps = false;

    public function premadeBoxes()
    {
    	return $this->hasMany('App\PremadeBox');
    }
}

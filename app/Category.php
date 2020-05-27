<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public $timestamps = false;

    public function boxes()
    {
    	return $this->hasMany('App\Box');
    }

    public function items()
    {
    	return $this->hasMany('App\Item');
    }

    public function premadeBoxes()
    {
    	return $this->hasMany('App\PremadeBox');
    }
}

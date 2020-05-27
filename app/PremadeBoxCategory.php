<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PremadeBoxCategory extends Model
{
	protected $fillable = ['name'];

    public $timestamps = false;

    public function premadeBoxes()
    {
    	return $this->hasMany('App\PremadeBox');
    }

    public function scopeWithRelations(Builder $query)
    {
    	return $query->with('premadeBoxes');
    }
}

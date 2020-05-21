<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
	protected $fillable = ['name', 'description', 'price', 'quantity'];

    public function image()
    {
    	return $this->morphOne('App\Image', 'imageable');
    }

    public function transactions()
    {
    	return $this->hasMany('App\Transaction');
    }

    public function scopeWithRelations(Builder $query)
    {
        return $query->with(['image', 'transactions']);
    }
}

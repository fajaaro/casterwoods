<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    protected $fillable = ['category_id', 'name', 'description', 'price', 'quantity'];

    public function images()
    {
    	return $this->morphMany('App\Image', 'imageable');
    }

    public function transactions()
    {
    	return $this->hasMany('App\Transaction');
    }

    public function scopeWithRelations(Builder $query)
    {
        return $query->with(['images', 'transactions']);
    }
}

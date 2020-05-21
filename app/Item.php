<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['category_id', 'name', 'type', 'description', 'price', 'quantity'];

    public function category()
    {
    	return $this->belongsTo('App\Category');
    }

    public function images()
    {
    	return $this->morphMany('App\Image', 'imageable');
    }

    public function itemTransactions()
    {
    	return $this->hasMany('App\ItemTransaction');
    }

    public function scopeWithRelations(Builder $query)
    {
        return $query->with(['category', 'images', 'itemTransactions']);
    }
}

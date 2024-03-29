<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PremadeBox extends Model
{
    protected $fillable = ['premade_box_category_id', 'name', 'type', 'description', 'price', 'quantity'];

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

    public function scopeWithRelations(Builder $query)
    {
        return $query->with(['images', 'premadeTransactions', 'premadeBoxCategory']);
    }
}

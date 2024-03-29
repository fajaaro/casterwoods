<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public $timestamps = false;

    public function items()
    {
    	return $this->hasMany('App\Item');
    }

    public function scopeWithRelations(Builder $query)
    {
        return $query->with('items');
    }
}

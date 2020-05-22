<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ItemTransaction extends Model
{
    public $timestamps = false;

    protected $guarded = ['id'];

    public function item()
    {
    	return $this->belongsTo('App\Item');
    }

    public function transaction()
    {
    	return $this->belongsTo('App\Transaction');
    }

    public function scopeWithRelations(Builder $query) 
    {
    	return $query->with(['item', 'transaction']);
    }
}

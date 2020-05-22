<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function box()
    {
    	return $this->belongsTo('App\Box');
    }

    public function card()
    {
    	return $this->belongsTo('App\Card');
    }

    public function courier()
    {
    	return $this->belongsTo('App\Courier');
    }

    public function itemTransactions()
    {
        return $this->hasMany('App\ItemTransaction');
    }

    public function scopeWithRelations(Builder $query)
    {
        return $query->with(['user', 'box', 'card', 'courier', 'itemTransactions']);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PremadeTransaction extends Model
{
    protected $fillable = ['user_id', 'premade_box_id', 'courier_id', 'card_id', 'card_content', 'receiver_name', 'receiver_address', 'receiver_contact', 'total_price'];

    public function courier()
    {
    	return $this->belongsTo('App\Courier');
    }

    public function premadeBox()
    {
    	return $this->belongsTo('App\PremadeBox');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function card()
    {
        return $this->belongsTo('App\Card');
    }    

    public function scopeWithRelations(Builder $query)
    {
        return $query->with(['courier', 'premadeBox', 'user', 'card']);
    }
}

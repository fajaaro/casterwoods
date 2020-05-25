<?php

namespace App\Http\Requests\PremadeTransaction;

use Illuminate\Foundation\Http\FormRequest;

class StorePremadeTransaction extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => ['required'],
            'premade_box_id' => ['required'],
            'card_id' => ['required'],
            'courier_id' => ['required'],
            'receiver_name' => ['required'],
            'receiver_address' => ['required'],
            'receiver_contact' => ['required'],
        ];
    }
}

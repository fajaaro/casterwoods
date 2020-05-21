<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransaction extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => ['required'],
            'box_id' => ['required'],
            'card_id' => ['required'],
            'courier_id' => ['required'],
            'card_content' => ['required'],
            'receiver_name' => ['required'],
            'receiver_address' => ['required'],
        ];
    }
}

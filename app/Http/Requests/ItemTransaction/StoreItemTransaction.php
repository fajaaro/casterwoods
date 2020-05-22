<?php

namespace App\Http\Requests\ItemTransaction;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemTransaction extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'transaction_id' => ['required'],
            'item_id' => ['required'],
            'quantity' => ['required'],
        ];
    }
}

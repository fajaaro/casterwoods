<?php

namespace App\Http\Requests\ItemTransaction;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemTransaction extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'quantity' => ['required'],
        ];
    }
}

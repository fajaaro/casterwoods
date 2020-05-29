<?php

namespace App\Http\Requests\Box;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBox extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required'],
            'description' => ['required'],
            'price' => ['required'],
            'quantity' => ['required'],
        ];
    }
}

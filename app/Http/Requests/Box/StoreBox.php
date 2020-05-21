<?php

namespace App\Http\Requests\Box;

use Illuminate\Foundation\Http\FormRequest;

class StoreBox extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'category_id' => ['required'],
            'name' => ['required'],
            'description' => ['required'],
            'price' => ['required'],
            'quantity' => ['required'],
            'images' => ['required'],
        ];
    }
}

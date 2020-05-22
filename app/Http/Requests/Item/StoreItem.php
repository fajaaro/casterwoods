<?php

namespace App\Http\Requests\Item;

use Illuminate\Foundation\Http\FormRequest;

class StoreItem extends FormRequest
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
            'type' => ['required'],
            'price' => ['required'],
            'quantity' => ['required'],
            'images' => ['required'],            
        ];
    }
}
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

- id int [pk]
- category_id int [fk from categories table]
- name string
- type string
- description text nullable
- price int
- quantity int
- created_at timestamp
- updated_at timestamp
- relation to images table (polymorphic one to many)
- relation to item_transactions table (one to many)
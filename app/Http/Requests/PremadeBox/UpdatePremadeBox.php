<?php

namespace App\Http\Requests\PremadeBox;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePremadeBox extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'premade_box_category_id' => ['required'],
            'name' => ['required'],
            'type' => ['required'],
            'price' => ['required'],
            'quantity' => ['required'],
        ];
    }
}

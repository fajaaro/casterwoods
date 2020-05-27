<?php

namespace App\Http\Requests\PremadeBoxCategory;

use Illuminate\Foundation\Http\FormRequest;

class StorePremadeBoxCategory extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required'],
        ];
    }
}

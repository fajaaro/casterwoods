<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Category extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name, 
            'boxes' => $this->whenLoaded('boxes'),           
            'items' => $this->whenLoaded('items'),           
        ];
    }
}

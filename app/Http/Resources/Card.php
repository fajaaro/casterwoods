<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Card extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at,
            'image' => $this->whenLoaded('image'),
            'transactions' => $this->whenLoaded('transactions'),
        ];
    }
}

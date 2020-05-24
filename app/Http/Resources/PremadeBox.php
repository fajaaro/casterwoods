<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PremadeBox extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'premade_box_category_id' => $this->premade_box_category_id,
            'name' => $this->name,
            'type' => $this->type,
            'description' => $this->description,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at,
            'images' => $this->whenLoaded('images'),
            'premade_transactions' => $this->whenLoaded('premadeTransactions'),
        ];
    }
}

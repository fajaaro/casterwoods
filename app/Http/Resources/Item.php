<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Item extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'name' => $this->name,
            'type' => $this->type,
            'description' => $this->description,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at,
            'category' => $this->whenLoaded('category'),
            'images' => $this->whenLoaded('images'),
            'item_transactions' => $this->whenLoaded('itemTransactions'),
        ];
    }
}

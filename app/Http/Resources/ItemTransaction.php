<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemTransaction extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'transaction_id' => $this->transaction_id,
            'item_id' => $this->item_id,
            'quantity' => $this->quantity,
            'transaction' => $this->whenLoaded('transaction'),
            'item' => $this->whenLoaded('item'),
        ];
    }
}

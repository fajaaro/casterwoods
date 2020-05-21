<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Transaction extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'box_id' => $this->box_id,
            'card_id' => $this->card_id,
            'courier_id' => $this->courier_id,
            'card_content' => $this->card_content,
            'receiver_name' => $this->receiver_name,
            'receiver_address' => $this->receiver_address,
            'total_price' => $this->calculateTotalPrice(),
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at,
            'item_transaction' => $this->whenLoaded('itemTransaction'),
        ];
    }

    private function calculateTotalPrice()
    {
        $boxPrice = $this->box_id->price;
        $cardPrice = $this->card_id->price;
        $itemsPrice = $this->itemTransactions()->item->sum('price');

        return $boxPrice + $cardPrice + $itemsPrice;
    }
}
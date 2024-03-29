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
            'additional_note' => $this->additional_note,
            'receiver_name' => $this->receiver_name,
            'receiver_address' => $this->receiver_address,
            'receiver_contact' => $this->receiver_contact,
            'total_price' => $this->total_price,
            'order_key' => $this->order_key,
            'status' => $this->status,
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at,
            'item_transactions' => $this->whenLoaded('itemTransactions'),
            'user' => $this->whenLoaded('user'),
            'box' => $this->whenLoaded('box'),
            'card' => $this->whenLoaded('card'),
            'courier' => $this->whenLoaded('courier'),
        ];
    }
}
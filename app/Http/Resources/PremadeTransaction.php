<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PremadeTransaction extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'premade_box_id' => $this->premade_box_id,
            'courier_id' => $this->courier_id,
            'card_content' => $this->card_content,
            'additional_note' => $this->additional_note,
            'receiver_name' => $this->receiver_name,
            'receiver_address' => $this->receiver_address,
            'receiver_contact' => $this->receiver_contact,
            'total_price' => $this->total_price,
            'status' => $this->status,
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at,
            'courier' => $this->whenLoaded('courier'),
            'premade_box' => $this->whenLoaded('premadeBox'),
            'card' => $this->whenLoaded('card'),
            'user' => $this->whenLoaded('user'),
        ];
    }
}

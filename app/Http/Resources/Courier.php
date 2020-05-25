<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Courier extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'transactions' => $this->whenLoaded('transactions'),
            'premade_transactions' => $this->whenLoaded('premadeTransactions'),
        ];
    }
}

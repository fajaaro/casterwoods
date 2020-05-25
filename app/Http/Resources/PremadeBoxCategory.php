<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PremadeBoxCategory extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'premade_boxes' => $this->whenLoaded('premadeBoxes'),
        ];
    }
}

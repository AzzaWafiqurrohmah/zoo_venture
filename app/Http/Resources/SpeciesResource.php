<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SpeciesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' =>$this->id,
            'scientific_name' => $this->scientific_name,
            'name' => $this->name,
            'origin' => $this->origin,
            'image' => $this->image,
            'description' => $this->description,
            'article' => $this->article,
            'location_id' =>$this->location_id
        ];
    }
}

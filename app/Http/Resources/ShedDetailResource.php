<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShedDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'color' => $this->color,
            'total_specs' => $this->species?->count() ?? 0,
            'specs' => SpeciesResource::collection($this->species),
            'coordinates' => array_map(
                fn ($coordinate) => explode(',', $coordinate),
                $this->coordinates
            ),
        ];
    }
}

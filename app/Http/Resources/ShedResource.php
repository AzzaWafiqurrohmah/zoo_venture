<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShedResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'color' => $this->color,
            'coordinates' => array_map(
                fn ($coordinate) => explode(',', $coordinate),
                $this->coordinates
            ),
        ];
    }
}

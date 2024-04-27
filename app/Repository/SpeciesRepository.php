<?php

namespace App\Repository;

use App\Models\Species;
use Illuminate\Support\Facades\Storage;

class SpeciesRepository{
    public static function save(array $data, ?Species $species = null)
    {
        if (isset($data['image']))
            $data['image'] = $data['image']->storePublicly('species', 'public');

        if ($species && isset($data['image']))
            Storage::disk('public')->delete($species->image);

        if ($species) {
            $species->update($data);
            return $species;
        }

        return Species::create($data);
    }
}
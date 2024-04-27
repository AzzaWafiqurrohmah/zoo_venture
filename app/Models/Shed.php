<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shed extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'name', 'coordinates', 'color'
    ];

    protected $casts = [
        'coordinates' => 'array'
    ];

    public function species() :HasMany
    {
        return $this->hasMany(Species::class);
    }

}

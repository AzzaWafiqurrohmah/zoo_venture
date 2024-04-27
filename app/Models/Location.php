<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'shed_id', 'coordinates'
    ];

    protected $casts = [
        'coordinates' => 'array'
    ];

    public function shed() :BelongsTo
    {
        return $this->belongsTo(Shed::class);
    }

    public function species() :HasMany
    {
        return $this->hasMany(Species::class);
    }
}

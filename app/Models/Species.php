<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Species extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'location_id', 'scientific_name', 'name', 'image',
        'origin', 'description', 'article'
    ];

    public function location() :BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}

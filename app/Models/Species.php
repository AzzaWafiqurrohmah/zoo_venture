<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'location_id', 'scientific_name', 'name', 'image',
        'origin', 'description'
    ];
}

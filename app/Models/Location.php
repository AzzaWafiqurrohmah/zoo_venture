<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}

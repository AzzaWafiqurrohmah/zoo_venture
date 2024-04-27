<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Code extends Authenticatable
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'code', 'expired'
    ];

    protected $casts = [
        'expired' => 'datetime'
    ];
}

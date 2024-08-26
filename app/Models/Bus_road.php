<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus_road extends Model
{
    use HasFactory;
    protected $fillable = [
        'road_id',
        'latitude',
        'longitude',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localizacion extends Model
{
    use HasFactory;
    protected $table='localizacions';
    protected $fillable = [
        'Email',
        'latitude',
        'longitude',
    ];

}

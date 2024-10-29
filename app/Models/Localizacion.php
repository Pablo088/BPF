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

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function bus_line(){
        return $this->hasOne(Bus_line::class, 'id', 'line_id');
    }
}

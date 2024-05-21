<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'departure_time',
        'line_id',
        'stop_id',
        'status',
    ];

    public function line(){
        return $this->hasOne(Bus_line::class);
    }
    public function stop(){
        return $this->hasMany(Bus_stop::class);
    }
}

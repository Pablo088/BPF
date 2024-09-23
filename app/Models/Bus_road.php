<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bus_line;

class Bus_road extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'road_group',
        'latitude',
        'longitude',
        'order',
    ];

    public function Bus_line(){
        return $this->belongsTo(Bus_line::class, 'road_group', 'id');
    }
}

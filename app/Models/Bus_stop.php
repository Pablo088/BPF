<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LineHasStop;
use App\Models\Bus_line;

class Bus_stop extends Model
{
    use HasFactory;
    protected $fillable = [
        'direction',
        'latitude',
        'longitude',
    ];

    public function linesHasStops(){
        return $this->hasMany(LineHasStop::class, 'busStop_id', 'id');
    }
    public function busLines(){
        return $this->belongsToMany(Bus_line::class, 'line_has_stops', 'busStop_id', 'busLine_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BusCompany;
use App\Models\LineHasStop;
use App\Models\Bus_stop;

class Bus_line extends Model
{
    use HasFactory;
    protected $fillable = [
        'line_name',
        'company_id',
        'horarios'
    ];
    
    public function BusCompany(){
        return $this->belongsTo(BusCompany::class, 'company_id', 'id');
    }

<<<<<<< HEAD
    public function LinesHasStop(){
        return $this->hasMany(LineHasStop::class);
=======
    public function linesHasStops(){
        return $this->hasMany(LineHasStop::class, 'busLine_id', 'id');
    }

    public function busStops(){
        return $this->belongsToMany(Bus_stop::class, 'line_has_stops', 'busLine_id', 'busStop_id');
>>>>>>> f4e997bbce6f8353f130c71ce4e9c78ba8132f90
    }
}

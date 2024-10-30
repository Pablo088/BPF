<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BusCompany;
use App\Models\LineHasStop;
use App\Models\Bus_stop;
use App\Models\Bus_road;
use App\Models\UserHasLine;

class Bus_line extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'line_name',
        'company_id',
        'horarios'
    ];
    
    public function BusCompany(){
        return $this->belongsTo(BusCompany::class, 'company_id', 'id');
    }

    public function linesHasStops(){
        return $this->hasMany(LineHasStop::class, 'busLine_id', 'id');
    }

    public function busStops(){
        return $this->belongsToMany(Bus_stop::class, 'line_has_stops', 'busLine_id', 'busStop_id');
    }

    public function Bus_road(){
        return $this->hasMany(Bus_road::class, 'road_group', 'id');
    }

    public function Localizacion(){
        return $this->hasOne(Localizacion::class, 'line_id', 'id');
    }
    public function UserHasLine(){
        return $this->hasOne(UserHasLine::class,'line_id');
    }
}

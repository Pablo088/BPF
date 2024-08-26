<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineHasStop extends Model
{
    use HasFactory;
    
    public function busLine(){
        return $this->hasMany(Bus_line::class);
    }
    public function busStop(){
        return $this->hasMany(Bus_stop::class);
    }
}

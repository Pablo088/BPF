<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bus_line;
use App\Models\Bus_stop;

class LineHasStop extends Model
{
    use HasFactory;
    
    public function busLine(){
        return $this->belongsTo(Bus_line::class, 'busLine_id', 'id');
    }

    public function busStop(){
        return $this->belongsTo(Bus_stop::class, 'busStop_id', 'id');
    }
}

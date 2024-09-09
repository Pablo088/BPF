<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus_line extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];
    
    public function BusCompany(){
        $this->belongsTo(BusCompany::class);
    }

    public function LinesHasStop(){
        return $this->belongsTo(LineHasStop::class);
    }
}

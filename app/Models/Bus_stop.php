<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus_stop extends Model
{
    use HasFactory;
    protected $fillable = [
        'direction',
        'latitude',
        'longitude',
    ];

    public function LinesHasStop(){
        return $this->belongsTo(LineHasStop::class);
    }
}
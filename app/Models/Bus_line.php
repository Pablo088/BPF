<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BusCompany;

class Bus_line extends Model
{
    use HasFactory;
    protected $fillable = [
        'line_name',
        'company_id',
        'horarios'
    ];
    
    public function BusCompany(){
       return $this->hasMany(Bus_line::class, 'company_id', 'id');
    }

    public function LinesHasStop(){
        return $this->hasMany(LineHasStop::class);
    }
}

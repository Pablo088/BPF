<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bus_line;

class BusCompany extends Model
{
    use HasFactory;

    public function BusLine(){
        $this->hasMany(Bus_line::class,'company_id','id');
    }
}
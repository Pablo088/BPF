<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bus_line;
use App\Models\Bus_road;

class BusCompany extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
    ];
    public function Bus_Line(){
        return $this->hasMany(Bus_line::class, 'company_id', 'id');
    }

    public function Bus_road(){
        return $this->hasMany(Bus_road::class, 'Bus_line', 'id', 'company_id');
    }
}
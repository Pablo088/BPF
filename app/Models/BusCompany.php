<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bus_line;

class BusCompany extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
    ];
    public function Bus_Line(){
        return $this->hasMany(BusLine::class, 'company_id', 'id');
    }
}
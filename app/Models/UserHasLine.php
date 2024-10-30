<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Bus_line;

class UserHasLine extends Model
{
    use HasFactory;

    public function User(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function BusLine(){
        return $this->belongsTo(Bus_line::class,'line_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Bus_line;

class UserHasLine extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'line_id',
    ];
    protected $table = 'users_has_lines';
    public function User(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function BusLine(){
        return $this->belongsTo(Bus_line::class,'line_id');
    }
}

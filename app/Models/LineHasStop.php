<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bus_line;
use App\Models\Bus_stop;
use Spatie\Permission\Models\Role;
use App\Models\User;

class LineHasStop extends Model
{
    use HasFactory;
    protected static function booted(): void
    {

       /*  static::created(function (User $user){
            $user->assignRole('User');
        }); */
        static::created(function (LineHasStop $lineHasStop) {
            // Aquí puedes realizar acciones con $lineHasStop si es necesario
        });
    }
    public function busLine(){
        return $this->belongsTo(Bus_line::class, 'busLine_id', 'id');
    }

    public function busStop(){
        return $this->belongsTo(Bus_stop::class, 'busStop_id', 'id');
    }
}
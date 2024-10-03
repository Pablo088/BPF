<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserStop;

class UserController extends Controller
{
    public function dashboard(Request $request){
        $user = $request->user();
        if($user !== null){
            $consulta = UserStop::select("bus_stops.id as stopId","direction","latitude","longitude")
            ->join("bus_stops","users_stops.stop_id","=","bus_stops.id")
            ->join("users","users_stops.user_id","=","users.id")
            ->where("users_stops.user_id",$user->id)
            ->groupBy("bus_stops.id")
            ->get();

            $userStops = ($consulta->isEmpty() !== true) ? $consulta : false;
            
            return view('dashboard',compact("userStops"));
        } else{
            return redirect()->back();
        }
    }
    public function guardarParada(Request $request){
        $user = $request->user();
        $stop = $request;
        if($user !== null){
            $consulta = UserStop::where("stop_id",$stop->paradaId)->get();
            if($consulta->count() == 0){
                $userStop = new UserStop();
                $userStop->user_id = $user->id;
                $userStop->stop_id = $stop->paradaId;
        
                $userStop->save();
                session()->flash("success","¡Tu parada fue guardada!");
                return redirect()->back();
            }else{
                session()->flash("error","Ya seleccionaste esta parada");
                return redirect()->back();
            }
        } else{
            session()->flash("error","Para usar esta funcionalidad, necesitas iniciar sesion");
            return redirect()->back();
        }
    }
}

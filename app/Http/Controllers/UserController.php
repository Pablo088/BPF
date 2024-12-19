<?php

namespace App\Http\Controllers;

use App\Models\Bus_line;
use Illuminate\Http\Request;
use App\Models\UserStop;
use App\Models\User;
use App\Models\UserHasLine;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
        $user = $request->user()->id??null;
        $stop = $request;
        if($user !== null){
            $consulta = UserStop::where("stop_id",$stop->paradaSeleccionada)
            ->where('user_id',$user)
            ->get();
            if($consulta->count() == 0){
                $userStop = new UserStop();
                $userStop->user_id = $user;
                $userStop->stop_id = $stop->paradaSeleccionada;        
                $userStop->save();

                return redirect()->back()->with('success', '¡Tu parada fue guardada!');
            }
        }else{
            return redirect()->back()->with('error', 'Para usar esta funcionalidad, necesitas iniciar sesion');
        }
    }
    public function eliminarParada(Request $request,$stopId){
        $userId = $request->user()->id;
        $id = UserStop::select("id")->where("user_id",$userId)->where("stop_id",$stopId)->delete();

        return redirect()->back()->with("success","Tu parada fue eliminada");
    }
    public function listadoUsuarios(Request $request){
        $users = User::where('id','<>',$request->user()->id)->get();
        $userLine = UserHasLine::join('bus_lines',"users_has_lines.line_id","=","bus_lines.id")
        ->join('users',"users_has_lines.user_id","=","users.id")
        ->where('user_id',$id)
        ->get()??null;
        return view("admin\user_rol", compact("users"));
    }
    public function getUserInfo(Request $request, $id){
        return view("admin\manage_user",compact('id','userLine'));
    }
    public function cambiarRol(Request $request,$id){
        $user = User::find($id);
        $lines = null;
        $user->syncRoles($request->cambiarRol);
        if($request->cambiarRol == 'Admin'){
            $user->syncPermissions('dashboard.users');
        }
        if($request->cambiarRol == 'Colectivero'){
            $lines = Bus_line::all();
        }
        return redirect()->back()->with( ['lines' => $lines] );
    }
}

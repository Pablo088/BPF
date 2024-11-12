<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus_line;
use App\Models\BusCompany;
use App\Models\LineHasStop;
use App\Models\Bus_stop;
use App\Models\UserHasLine;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class LineController extends Controller
{
    public function Lines(Request $request){
        //$lines = Bus_line::all();
        $lines = Bus_line::with('BusCompany')->get();
        $userSession = Auth::user() !== null;
        //dd($busLines);
        $userSession = Auth::user() !== null;
        if($userSession !== false){
            $userRol = $request->user()->hasRole("Admin");
            return view('Lines', compact('lines','userSession', 'userRol'));
        }
        
    }
    public function LinesBusc($id){
        //dd($id);
        $busLines = Bus_line::with('busStops')->find($id);
        //dd($busLines);
        return response()->json($busLines);
        
    }

    public function Admin(){
        $buscompany=BusCompany::all();
        $busline=Bus_line::all();
        $busstop=Bus_stop::all();
        //dd($buscompany);
        return view('CompaniesAdmin', compact('buscompany','busline', 'busstop'));
    }
    public function añadircompany(Request $request){
        $request->validate([
            'company_name' => 'required|string|max:250',
        ],[
            'company_name.string'=>'El nombre debe ser una cadena de texto.',
            'company_name.max'=>'El nombre no debe tener más de 255 caracteres.',
        ]);
        //dd($request);
        $comp = new BusCompany();
        $comp-> company_name = $request->company_name;
        $comp-> created_at = now();
        $comp->save();
        return redirect()->back()->with('success', 'La compania de autobús ha sido creada correctamente.');
    }
    public function añadirlinea(Request $request){
        //dd($request);
        $request->validate([
            'line_name' => 'required|string|max:255|min:1',
            'company_id' => 'required',
            'horario_comienzo' => 'required',
            'horario_finalizacion' => 'required',
        ],[
            'line_name.required' => 'El nombre es obligatorio.',
            'line_name.string' => 'La dirección debe ser una cadena de texto.',
            'line_name.max' => 'La dirección no debe tener más de 255 caracteres.',
            
            'company_id.required' => 'El company id es obligatorio.',
        
            'horario_comienzo.required' => 'El horario es obligatorio.',

            'horario_finalizacion.required' => 'El horario es obligatorio.',]);
        $lin = new Bus_line();
        $lin-> line_name = $request->line_name;
        $lin-> horario_comienzo = $request->horario_comienzo;
        $lin-> horario_finalizacion = $request->horario_finalizacion;
        $lin-> color = $request->color;
        $lin-> company_id = $request->company_id;
        $lin-> created_at = now();
        $lin->save();
        return redirect()->back()->with('success', 'La línea de autobús ha sido creada correctamente.');
    }
    public function añadirrelacion(Request $request){
        $busLine_id = $request->busLine_id;
        $busStop_ids = json_decode($request->busStop_id);

        foreach ($busStop_ids as $busStop_id) {
            $relacion = LineHasStop::where('busLine_id', $busLine_id)
                                   ->where('busStop_id', $busStop_id)
                                   ->first();

            if (!$relacion) {
                $has = new LineHasStop();
                $has->busLine_id = $busLine_id;
                $has->busStop_id = $busStop_id;
                $has->created_at = now();
                $has->save();
            }
        }
        /* else if ($relaciones->isEmpty() == false) {
        
            return redirect()->back()->with('error', 'Esta relación ya existe.');;
        } */

        return redirect()->back()->with('success', 'Relaciones añadidas correctamente.');
    }

    public function añadirrelacion1a1(Request $request){
        $busLine_id = $request->busLine_id;
        $busStop_id = $request->busStop_id;

            $relacion = LineHasStop::where('busLine_id', $busLine_id)
                                   ->where('busStop_id', $busStop_id)
                                   ->first();

            if (!$relacion) {
                $has = new LineHasStop();
                $has->busLine_id = $busLine_id;
                $has->busStop_id = $busStop_id;
                $has->created_at = now();
                $has->save();
            }
        
        /* else if ($relaciones->isEmpty() == false) {
        
            return redirect()->back()->with('error', 'Esta relación ya existe.');;
        } */

        return redirect()->back()->with('success', 'Relaciones añadidas correctamente.');
    }


    public function editarCompania(){
        $buscompany=BusCompany::all();
        $busline=Bus_line::all();
        return view('CompaniesAdminEdit', compact('buscompany','busline'));
    }
    public function editarlinea($id){
        //dd($id);
        $buscompany=BusCompany::all();
        $busLines = Bus_line::with('busStops')->find($id);
        $Line = Bus_line::find($id);
        $users = User::whereHas('roles', function ($query) {
            $query->where('role_id', 3); // ID del rol deseado
        })->get();
        
        //dd($users);  

        //dd($Line);
        return view('EditLineas', compact('Line','buscompany','buscompany', 'users'));
    }

    public function Ceditar($id){
        //dd($id);
        $Stop = BusCompany::find($id);
        return view('EditCompanias', compact('Stop'));
    }

    public function Lenviar(Request $request){
        $request->validate([
            'line_name' => 'nullable|string|max:255|min:1',
            
        ],[
            'line_name.string' => 'La dirección debe ser una cadena de texto.',
            'line_name.max' => 'La dirección no debe tener más de 255 caracteres.',]);
        //dd($request);
        $ID=$request->id;
        $Elin = Bus_line::find($ID);
        $Elin-> line_name = $request->line_name;
        $Elin-> horario_comienzo = $request->horario_comienzo;
        $Elin-> horario_finalizacion = $request->horario_finalizacion;
        $Elin-> color = $request->color;
        $Elin-> company_id = $request->company_id;
        $Elin->save();
        
        $user = User::find($request->usuarios)??null;
        $linea = Bus_line::find($ID);
        $consulta = null;
        if($user !== null){
            $consulta = UserHasLine::where('user_id', $user->id)
            ->get();
       
        

        
        if($consulta->count() == 0){
            UserHasLine::updateOrCreate([
                'user_id' => $user->id,
                'line_id' => $linea->id,
            ]);
        }else{
            return redirect()->back()->with('error', 'Este colectivero ya esta asignado a una linea');
        }
    }

        return redirect()->back()->with('success', 'La línea de autobús ha sido editada correctamente.');
    }

    public function EliminarStop(Request $request){

        //dd($request);
        $lineHasStop = LineHasStop::where('busLine_id', $request->line_id)
                               ->where('busStop_id', $request->stop_id)
                               ->first();
        $lineHasStop->delete();
        return redirect()->back()->with('success', 'La parada de autobús ha sido eliminada correctamente.');
                       
    }

    public function Cenviar(Request $request){
        $request->validate([
            'company_namee' => 'nullable|string|max:255|min:1',
            
        ],[
            'company_name.string' => 'La dirección debe ser una cadena de texto.',
            'company_name.max' => 'La dirección no debe tener más de 255 caracteres.',]);
        $ID=$request->id;
        $Ecomp = BusCompany::find($ID);
        $Ecomp-> company_name = $request->company_name;
        $Ecomp->save();
        return redirect()->back();
    }

    public function Eliminarlinea($id){
        $ID=$id;
        $Elimlin = Bus_line::find($ID);
        $Elimlin->delete();
        return redirect()->back();
    }
    public function Eliminarcompania($id){
        $ID=$id;
        $Elimcom = BusCompany::find($ID);
        $Elimcom->delete();
        return redirect()->back();
    }
    
}

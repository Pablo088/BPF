<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus_line;
use App\Models\BusCompany;
use App\Models\LineHasStop;
use App\Models\Bus_stop;
use Illuminate\Support\Facades\Auth;


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
        }
        return view('Lines', compact('lines','userSession', 'userRol'));
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
        return redirect()->back();
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
        $lin-> company_id = $request->company_id;
        $lin-> created_at = now();
        $lin->save();
        return redirect()->back();
    }
    public function añadirrelacion(Request $request){
      
        $relaciones = LineHasStop::where('busLine_id', $request->busLine_id)->where('busStop_id', $request->busStop_id)->get();
        //dd($relaciones->isEmpty());
        if ($relaciones->isEmpty() == true) {
        $request->validate([
            'busStop_id' => 'required',
            'busLine_id' => 'required',
        ],[
            'busStop_id.required' => 'Este campo es obligatorio es obligatorio.',

            'busLine_id.required' =>'Este campo es obligatorio es obligatorio.',]);
        //dd($request);
        $has = new LineHasStop();
        $has-> busLine_id = $request->busLine_id;
        $has-> busStop_id = $request->busStop_id;
        $has-> created_at = now();
        $has->save();
        return redirect()->back();
    }else if ($relaciones->isEmpty() == false) {
        
        return redirect()->back()->with('error', 'Esta relación ya existe.');;
    };}


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
        //dd($Line);
        return view('EditLineas', compact('Line','buscompany','buscompany'));
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
        $Elin-> company_id = $request->company_id;
        $Elin->save();
        return redirect()->back();
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

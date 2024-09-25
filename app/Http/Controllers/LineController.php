<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus_line;
use App\Models\BusCompany;
use App\Models\LineHasStop;
use App\Models\Bus_stop;


class LineController extends Controller
{
    public function Lines(){
        //$lines = Bus_line::all();
        $lines = Bus_line::with('BusCompany')->get();
        //dd($busLines);
        return view('Lines', compact('lines'));
    }
    public function LinesBusc($id){
        //dd($id);
        $busLines = Bus_line::with('busStops')->find($id);
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
        //dd($request);
        $comp = new BusCompany();
        $comp-> company_name = $request->company_name;
        $comp-> created_at = now();
        $comp->save();
        return redirect()->back();
    }
    public function añadirlinea(Request $request){
        //dd($request);
        $lin = new Bus_line();
        $lin-> line_name = $request->line_name;
        $lin-> horarios = $request->horarios;
        $lin-> company_id = $request->company_id;
        $lin-> created_at = now();
        $lin->save();
        return redirect()->back();
    }
    public function añadirrelacion(Request $request){
        //dd($request);
        $has = new LineHasStop();
        $has-> busLine_id = $request->busLine_id;
        $has-> busStop_id = $request->busStop_id;
        $has-> created_at = now();
        $has->save();
        return redirect()->back();
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
        //dd($Line);
        return view('EditLineas', compact('Line','buscompany','buscompany'));
    }

    public function Ceditar($id){
        //dd($id);
        $Stop = BusCompany::find($id);
        return view('EditCompanias', compact('Stop'));
    }

    public function Lenviar(Request $request){
        //dd($request);
        $ID=$request->id;
        $Elin = Bus_line::find($ID);
        $Elin-> line_name = $request->line_name;
        $Elin-> horarios = $request->horarios;
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

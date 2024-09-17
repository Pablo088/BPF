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
    
}

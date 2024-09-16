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
}

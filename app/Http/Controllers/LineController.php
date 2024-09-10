<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus_line;
use App\Models\BusCompany;

class LineController extends Controller
{
    public function Lines(){
        //$lines = Bus_line::all();
        $lines = Bus_line::with('BusCompany')->get();
        //dd($lines);
        return view('Lines', compact('lines'));
    }
}

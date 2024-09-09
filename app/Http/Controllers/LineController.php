<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus_line;

class LineController extends Controller
{
    public function Lines(){
        $lines = Bus_line::all();
        return view('Lines', compact('lines'));
    }
}

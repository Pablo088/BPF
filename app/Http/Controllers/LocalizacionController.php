<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Localizacion;

class LocalizacionController extends Controller
{
    public function store(Request $request)
    {
        //dd($request);
        
        // Guarda la ubicación en la base de datos
        Location::create([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        //return response()->json(['success' => true]);
        return response()->json($request->all());
    } 
}

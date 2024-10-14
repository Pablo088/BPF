<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Localizacion;

class LocalizacionController extends Controller
{
    public function store(Request $request)
    {
        //dd($request->all());
        
        // Guarda la ubicación en la base de datos
        $location=Localizacion::create([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);
        //dd($Localizacion);
        return response()->json(['success' => true, 'location'=>$location]);
        //return response()->json($location);
    } 
}

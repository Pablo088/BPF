<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Localizacion;

class LocalizacionController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();

        // Actualizar o crear la ubicación del usuario basado en su email
        Localizacion::updateOrCreate(
            ['Email' => $user->email], // Condición para encontrar el registro
            [
                'latitude' => $request->latitude, // Datos para actualizar o crear
                'longitude' => $request->longitude,
            ]
        );

        return response()->json(['success' => true]);
    } 
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Localizacion;
use Illuminate\Support\Facades\Auth;

class LocalizacionController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();

        // Validación de los datos
        $validated = $request->validate([
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        try {
            // Actualizar o crear la ubicación del usuario basado en su email
            Localizacion::updateOrCreate(
                ['Email' => $user->email], // Condición para encontrar el registro
                [
                    'latitude' => $validated['latitude'], // Datos para actualizar o crear
                    'longitude' => $validated['longitude'],
                ]
            );

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    } 
}

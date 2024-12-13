<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Localizacion;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserHasLine;

class LocalizacionController extends Controller
{
    public function show(){
        return view('locate\localizacion');
    }
    public function store(Request $request)
    {
        $user = Auth::user();
        $lineId = null;
        $userLine = UserHasLine::where('user_id', $user->id)->get();
        foreach($userLine as $userL){
            $lineId = $userL->line_id;
        }

        //dd($userLine->json());

        // Validación de los datos
        $validated = $request->validate([
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        try {
            // Actualizar o crear la ubicación del usuario basado en su email
            Localizacion::updateOrCreate(
                ['user_id' => $user->id],
                 // Condición para encontrar el registro
                [
                    'latitude' => $validated['latitude'], // Datos para actualizar o crear
                    'longitude' => $validated['longitude'],
                    'line_id' => $lineId,
                ]
            );

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    } 
}

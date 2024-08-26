<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus_stop;
use App\Models\Bus_road;
use Illuminate\Support\Facades\Auth;

class Bus_stopController extends Controller
{
    public function index(){
        $busStops = Bus_Stop::all();
        $roads = Bus_road::all()->groupBy("road_id");
            foreach ($roads as $road) {
                foreach ($road as $registry) {
                    dd($registry);
                }
            }
       
        return view('index', compact('busStops', 'roads'));
    }

    
    public function edit()
    {
        $busStops = Bus_Stop::all();
        return view('bus_stops', compact('busStops'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'direction' => 'nullable|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);
        //dd($request);
        Bus_Stop::create($request->all());

        return redirect()->back();
    }

    public function eliminar($id){
        //dd($id);
        $Buss = Bus_Stop::find($id);
        $Buss->delete();
        return redirect()->back();
    }

    public function edite($id){
        $stop = Bus_Stop::find($id);

        return view('Edit_Stop', [
            'stop' => $stop,
        ]);
    }

    public function editar(Request $request){
        //dd($request);
        $coordenadas = $request->input('latlon');
        $partes = explode(',', $coordenadas);
        $latitud = $partes[0];
        $longitud = $partes[1];

        //dd($latitud);
        $ida=$request->id;
        $edit= Bus_Stop::find($ida);
        $edit-> direction= $request->nombre;
        $edit-> latitude= $latitud;
        $edit-> longitude= $longitud;
        $edit-> save();
        return redirect()->route('bus-stop.admin');

    }
}

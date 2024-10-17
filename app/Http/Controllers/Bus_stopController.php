<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus_stop;
use App\Models\Bus_road;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Models\BusCompany;
use App\Models\Bus_line;
use Illuminate\Support\Facades\Auth;

class Bus_stopController extends Controller
{
    public function index(Request $request){
        $parada = $request->parada;
        $userRol = "";
        $busStops = Bus_Stop::all();
        $company = BusCompany::all();
        $roads = Bus_road::with(['Bus_line.BusCompany']) // Cargar la relación 'busLine'
                ->orderBy('road_group', 'asc')
                ->orderBy('order', 'asc')
                ->get();

    
    $rutas = [];
    foreach ($roads as $fila) {
        $grupo = $fila->road_group;
        if (!isset($rutas[$grupo])) {
           $linename=$fila->Bus_line;
           //dd($linename);
            
            $rutas[$grupo] = [
                'grupo' => $grupo,
                'nombre' => $fila->Bus_line->line_name,
                'empresa' => $fila->Bus_line->BusCompany->company_name,
                'id_empresa' => $fila->Bus_line->BusCompany->id,
                'color' => $fila->Bus_line->color,
                'coordenadas' => [],
            ];
            
        }
        $rutas[$grupo]['coordenadas'][] = [
            (float)$fila->latitude,
            (float)$fila->longitude
        ];
       
    }
    $rutas = array_values($rutas);
    $rutas = json_encode($rutas);
    $userSession = Auth::user() !== null;
    if($userSession !== false){
        $userRol = $request->user()->hasRole("Admin");
    }
   
    return view('index', compact('busStops','rutas','userRol','userSession','parada'));
}

    
    public function edit(Request $request)
    {
        $userSession = Auth::user() !== null;
        $busStops = Bus_Stop::all();
        return view('bus_stops', compact('busStops','userSession'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'direction' => 'nullable|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ],[
            'direction.string' => 'La dirección debe ser una cadena de texto.',
            'direction.max' => 'La dirección no debe tener más de 255 caracteres.',
            
            
            'latitude.required' => 'La latitud es obligatoria.',
            'latitude.numeric' => 'La latitud debe ser un número válido.',
            
            
            'longitude.required' => 'La longitud es obligatoria.',
            'longitude.numeric' => 'La longitud debe ser un número válido.',]);
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

    public function routes()
    {
        $busStops = Bus_Stop::all();
        //$roads = Bus_road::orderBy('road_group', 'asc')->orderBy('order', 'asc')->get();
        $roads = Bus_road::with(['Bus_line.BusCompany']) // Cargar la relación 'busLine'
                ->orderBy('road_group', 'asc')
                ->orderBy('order', 'asc')
                ->get();

        $rutas = [];
        foreach ($roads as $fila) {
        $grupo = $fila->road_group;
        if (!isset($rutas[$grupo])) {
            $rutas[$grupo] = [
                'grupo' => $grupo,
                'nombre' => $fila->Bus_line->line_name,
                'empresa' => $fila->Bus_line->BusCompany->company_name,
                'id_empresa' => $fila->Bus_line->BusCompany->id,
                'color' => $fila->Bus_line->color,
                'coordenadas' => [],
            ];
        }
        $rutas[$grupo]['coordenadas'][] = [
            (float)$fila->latitude,
            (float)$fila->longitude
        ];
       
    }

        $rutas = array_values($rutas);
        $rutas = json_encode($rutas);
        return view('routes', compact('busStops','rutas'));
    }

    public function storeroutes(Request $request)
    {
        $latitudes = $request->input('latitude');
        $longitudes = $request->input('longitude');
        $roadGroup = $request->road_group;

        //dd($request);

       for ($i = 1; $i < count($latitudes); $i++) {
            Bus_road::create([
                'road_group' => $roadGroup,
                'latitude' => $latitudes[$i],
                'longitude' => $longitudes[$i],
                'order' => $i
            ]);
        }

        return redirect()->back()->with('success', 'Ruta guardada correctamente');
    }
    public function eliminarRutas($road_group){
        //dd($road_group);
        $road_groups=$road_group;
        Bus_road::where('road_group', $road_groups)->delete();
        return redirect()->back()->with('success', 'Ruta eliminada correctamente');
    }
}

    

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus_stop;
use App\Models\Bus_road;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Models\BusCompany;
use App\Models\Bus_line;
use App\Models\UserStop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;
use App\Models\Localizacion;

class Bus_stopController extends Controller
{
    public function index(Request $request){
        $user = $request->user()->id??null;
        
        $consulta = UserStop::select("bus_stops.id as stopId","direction","latitude","longitude")
        ->join("bus_stops","users_stops.stop_id","=","bus_stops.id")
        ->join("users","users_stops.user_id","=","users.id")
        ->where("users_stops.user_id",$user)
        ->groupBy("bus_stops.id")
        ->get();

        $comparacion = UserStop::select("bus_stops.id as stopId")
        ->join("bus_stops","users_stops.stop_id","=","bus_stops.id")
        ->join("users","users_stops.user_id","=","users.id")
        ->where("users_stops.user_id",$user)
        ->groupBy("bus_stops.id")
        ->get();
    
        $parada = Bus_Stop::find($request->parada);
        $userRol = "";
        $userDriver = "";
        $busStops = Bus_Stop::whereNotIn('id',$comparacion)->get();
        $company = BusCompany::all();
        $roads = Bus_road::with(['Bus_line.BusCompany']) // Cargar la relación 'busLine'
                ->orderBy('road_group', 'asc')
                ->orderBy('order', 'asc')
                ->get();

    
    $rutas = [];
    foreach ($roads as $fila) {

        $grupo = $fila->road_group;
        //dd ($fila);
        if (!isset($rutas[$grupo])) {
           //$linename=$fila->Bus_line;
           //dd($linename);

            $rutas[$grupo] = [
                'grupo' => $grupo,
                'nombre' => $fila->Bus_line->line_name,
                'empresa' => $fila->Bus_line->BusCompany->company_name,
                'id_empresa' => $fila->Bus_line->BusCompany->id,
                'color' => $fila->Bus_line->color,
                'color_rutas' => $fila->color,
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
        $userDriver = $request->user()->hasRole("Colectivero");
    }
   
    return view('index', compact('busStops','rutas','userRol','userSession','parada','consulta', 'userDriver'));
}

    
    public function edit(Request $request)
    {
        $userSession = Auth::user() !== null;
        $busStops = Bus_Stop::all();
        return view('admin\add\bus_stops', compact('busStops','userSession'));
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

        return view('admin\edit\Edit_Stop', [
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
                'color_rutas' => $fila->color,
                'coordenadas' => [],
            ];
        }
        $rutas[$grupo]['coordenadas'][] = [
            (float)$fila->latitude,
            (float)$fila->longitude
        ];
       
    }
        $totalRutas = Bus_Line::count();
        $lineas = Bus_Line::all();
        $rutas = array_values($rutas);
        $rutas = json_encode($rutas);
        return view('admin\add\bus_routes', compact('busStops', 'rutas', 'totalRutas', 'lineas'));
    }

    public function storeroutes(Request $request)
    {
        $latitudes = $request->input('latitude');
        $longitudes = $request->input('longitude');
        $roadGroup = $request->road_group;
        $color = $request->color;

        //dd($request);

       for ($i = 1; $i < count($latitudes); $i++) {
            Bus_road::create([
                'road_group' => $roadGroup,
                'latitude' => $latitudes[$i],
                'longitude' => $longitudes[$i],
                'order' => $i,
                'color' => $color
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


    

public function getLocalizaciones()
{
    $localizaciones = Localizacion::with(['user', 'bus_line'])->get();
    return response()->json($localizaciones);
}
}
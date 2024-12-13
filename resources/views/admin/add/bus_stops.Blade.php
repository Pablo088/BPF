<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paradas de Colectivo</title>
    <link rel="stylesheet" href="{{ asset('css\menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css\admin\add\bus_stops.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" />
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> --}}
</head>
<body>
    <div class="open-menu" onclick="openMenu()">&#9776;</div>
    <div id="overlay" class="overlay" onclick="closeMenu()"></div>
    
    <div id="menu" class="menu">
        <a href="javascript:void(0)" class="closebtn" onclick="closeMenu()">&times;</a>
        <a href="{{ route('bus-stops.index')}}">Inicio</a>
        @if ($userSession !== true)
            <a href="{{ route('login') }}">Iniciar sesión</a>
            <a href="{{route('register')}}">Registrarse</a>
        @endif
      
        <a href="{{route('LinesView')}}">Lineas</a>
        <a href="{{route('LinesAdmin')}}">Administrar Lineas</a>
        <a href="{{route('bus-stops.routes')}}">Administrar Rutas</a>
        <a>
            Mostrar Paradas de Colectivo
            <input type="checkbox" id="mostrarParadas" value="" name="Paradas" class="check" onchange="sm()" checked> 
        </a>
        <a>
            Mostrar Rutas de Colectivo
            <input type="checkbox" id="mostrarRutas" value="" name="Rutas" class="check" onchange="sr()" checked> 
        </a>
    </div>

    <input type="hidden" id="busStops" value="{{$busStops}}">
    
    <div id="map"></div>
    <div class="form-container">
        <form method="POST" action="{{route('bus-stops.store')}}" id="formAdd" class="the-form">
            @csrf
            <label for="direction">Nombre:</label>
            <input type="text" id="direction" class="inputForm" name="direction" value = "direction" required>
            <label for="latitude">Latitud:</label>
            <input type="text" id="latitude" class="inputForm" name="latitude" value = "laitude" required>
            <label for="longitude">Longitud:</label>
            <input type="text" id="longitude" class="inputForm" name="longitude" value= "longitude" required>
            <button type="submit">Añadir Parada</button>
        </form>
    </div>
    
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif

    <script src="{{ asset('js\menu.js') }}"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>
</body>
    <script src="{{ asset('js\admin\add\bus_stops.js') }}"></script>
</html>
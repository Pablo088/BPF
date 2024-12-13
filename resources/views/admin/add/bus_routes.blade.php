<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paradas de Colectivo</title>
    <link rel="stylesheet" href="{{ asset('css\menu.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" />
    <link rel="stylesheet" href="{{ asset('css\admin\add\bus_routes.css') }}">
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> --}}
    <script src="{{ asset('js\menu.js') }}"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>
    <script src="{{ asset('js\jQuery.js') }}"></script>
</head>
<body>

   
    @if (session('error'))
        <script>
            alert("{{ session('error') }}");
        </script>
    @endif

    <div class="open-menu" onclick="openMenu()">&#9776;</div>
    <div id="overlay" class="overlay" onclick="closeMenu()"></div>

    <div id="searchContainer">
        <input type="text" id="searchInput" placeholder="Buscar parada...">
        <ul id="suggestions" class="suggestions-list"></ul>
    </div>
    
    <div id="menu" class="menu">
        <a href="javascript:void(0)" class="closebtn" onclick="closeMenu()">&times;</a>
        <a href="{{ route('bus-stops.index')}}">Inicio</a>
        <a href="{{route('bus-stop.admin')}}">Agregar Parada</a>
        <a href="{{route('LinesAdmin')}}">Administrar Lineas</a>
        <a>
            Mostrar Paradas de Colectivo
            <input type="checkbox" id="mostrarParadas" value="" name="Paradas" class="check" onchange="sm()" checked> 
        </a>
    </div>

    <input type="hidden" id="busStops" value="{{$busStops}}">
    <input type="hidden" id="busRoutes" value="{{$rutas}}">

    <div id="map"></div>

    {{-- <form method="POST" action="{{route('bus-stops.store')}}">
        @csrf
        <label for="name">Nombre:</label>
        <input type="text" id="direction" name="direction" value = "direction" required>
        <label for="latitude">Latitud:</label>
        <input type="text" id="latitude" name="latitude" value = "laitude" required>
        <label for="longitude">Longitud:</label>
        <input type="text" id="longitude" name="longitude" value= "longitude" required>
        <button type="submit">Añadir Parada</button>
    </form> --}}
    <button onclick="back()">↩</button>
    <button onclick="clearRoutes()">CLEAR</button>
    <div class="form-container">
        <form method="POST" action="{{route('bus-stops.storeroutes')}}">
            @csrf
            <label for="road_group">Conjunto ruta:</label>
            {{-- <input type="number" min="1" max="{{ $totalRutas }}" id="road_group" name="road_group" required> --}}
            <select id="road_group" name="road_group" required>
                <option value="" disabled selected>Seleccione una ruta</option>
                @foreach ($lineas as $linea)
                <option value="{{ $linea->id }}">{{ $linea->line_name }}</option>
                @endforeach
            </select>

            <label for="latitude"></label>
            <input type="hidden" id="latitude" name="latitude[]" required>

            <label for="longitude"></label>
            <input type="hidden" id="longitude"  name="longitude[]" required>

            <input type="color" id="color" name="color" required>

            {{-- <label for="orden">orden:</label>
            <a type="text" id="order"  name="order" required> --}}

            <label for="puntos">Puntos seleccionados:</label>
            <a id="puntos"></a>
            <button type="submit">Añadir Ruta</button>
            
        </form>
    </div>
    <div class="form-container">
        <form method="POST" action="{{route('relacion')}}">
            @csrf
                <label for="busStop_id">Parada:</label>
                <input type="text" id="busStop_id" name="busStop_id" required>
                <label for="busLine_id">Ruta:</label>
                {{-- <input type="number" id="busLine_id" name="busLine_id" required> --}}
                <select id="busLine_id" name="busLine_id" required>
                    <option value="" disabled selected>Seleccione una ruta</option>
                    @foreach ($lineas as $linea)
                    <option value="{{ $linea->id }}">{{ $linea->line_name }}</option>
                    @endforeach
                </select>
                <button type="submit">Añadir Relacion</button>
        </form>    
    </div>
</body>
    <script src="{{ asset('js\admin\add\bus_routes.js') }}"></script>
</html>

@extends('adminlte::page')
@section('content_header')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paradas de Colectivo</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" />
    <link rel="stylesheet" href="{{ asset('css\admin\add\bus_routes.css') }}">
    @vite('resources/css/admin/add/bus_routes.css')
@stop
@section('content')

    <div id="searchContainer">
        <input type="text" id="searchInput" placeholder="Buscar parada...">
        <ul id="suggestions" class="suggestions-list"></ul>
    </div>

    <input type="hidden" id="busStops" value="{{$busStops}}">
    <input type="hidden" id="busRoutes" value="{{$rutas}}">

    <div id="map"></div>

    <button onclick="back()">↩</button>
    <button onclick="clearRoutes()">CLEAR</button>
    <div class="form-container">
        <form method="POST" action="{{route('bus-stops.storeroutes')}}">
            @csrf
            <label for="road_group">Conjunto ruta:</label>
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

    <div id="mensaje-error" class="container">
        @if (session('error'))
            <input type="hidden" name="error" id="error" value="{{session('error')}}">
        @endif
    </div>

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>
<script src="{{ asset('js\jQuery.js') }}"></script>    
@vite('resources/js/admin/add/bus_routes.js')
@stop
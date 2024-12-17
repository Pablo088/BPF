@extends('adminlte::page')
@section('content_header')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paradas de Colectivo</title>
    @vite('resources/css/admin/bus_stop')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>
@stop
@section('content')

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

    
@vite('resources/js/admin/add/bus_stops')
@stop
@extends('adminlte::page')
@section('content_header')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paradas de Colectivo</title>

    <link rel="stylesheet" href="{{ asset('css\leaflet.css') }}">
    <link rel="stylesheet" href="{{ asset('css\MarkerCluster.css') }}">
    <link rel="stylesheet" href="{{ asset('css\MarkerCluster.Default.css') }}">
    @vite('resources/css/index.css') 
@stop
@section('content')
 <script>
    function guardarParada(checkbox) {
        let form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{route("user-stop.store")}}';
        

        let csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.id = 'token';
        csrfToken.value = '{{ csrf_token() }}'

        form.appendChild(csrfToken);
        form.appendChild(checkbox);
        document.body.appendChild(form);
        form.submit();
    }
 </script>
    <!-- para buscar las paradas  -->
    <div id="searchContainer">
        <input type="text" id="searchInput" placeholder="Buscar parada...">
        <ul id="suggestions" class="suggestions-list"></ul>
    </div>

    <input type="hidden" id="busStops" value="{{$busStops}}">
    <input type="hidden" id="busRoutes" value="{{$rutas}}">
    <input type="hidden" id="paradaUser" value="{{$parada}}">
    <input type="hidden" id="paradasGuardadas" class="paradasGuardadas" value="{{$consulta}}">

    <div id="map"></div>

    
    <div id="mensaje-exito" class="container">
        @if (session('success'))
            <input type="hidden" name="exito" id="exito" value="{{session('success')}}">
            @endif
    </div>
    <div id="mensaje-error" class="container">
        @if (session('error'))
        <input type="hidden" name="error" id="error" value="{{session('error')}}">
        @endif
    </div>

<script src="{{ asset('js\leaflet.js') }}"></script>
<script src="{{ asset('js\leaflet.markercluster.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>  
@vite('resources/js/index.js')
@stop
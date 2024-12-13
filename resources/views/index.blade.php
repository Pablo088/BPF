<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paradas de Colectivo</title>
    <link rel="stylesheet" href="{{ asset('css\menu.css') }}">
    {{--
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" /> --}}
    <link rel="stylesheet" href="{{ asset('css\leaflet.css') }}">
    {{--
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" /> --}}
    <link rel="stylesheet" href="{{ asset('css\MarkerCluster.css') }}">
    {{--
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" /> --}}
    <link rel="stylesheet" href="{{ asset('css\MarkerCluster.Default.css') }}">
    <link rel="stylesheet" href="{{ asset('css\index.css') }}">
    {{--
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script> --}}
    <script src="{{ asset('js\leaflet.js') }}"></script>
    {{--
    <script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script> --}}
    <script src="{{ asset('js\leaflet.markercluster.js') }}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.8.0/sweetalert2.min.css"
        rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.8.0/sweetalert2.min.js"></script>
    
</head>

<body>
    {{-- <button onclick="showMyLocation()">Mostrar mi ubicación</button> --}}

    <div class="open-menu" onclick="openMenu()">&#9776;</div>
    <div id="overlay" class="overlay" onclick="closeMenu()"></div>

    <!-- para buscar las paradas  -->
    <div id="searchContainer">
        <input type="text" id="searchInput" placeholder="Buscar parada...">
        <ul id="suggestions" class="suggestions-list"></ul>
    </div>
    <div id="menu" class="menu">
        <a href="javascript:void(0)" class="closebtn" onclick="closeMenu()">&times;</a>
        @if ($userSession !== true)
            <a href="{{ route('login') }}">Iniciar sesión</a>
            <a href="{{route('register')}}">Registrarse</a>
        @endif
        @if ($userDriver == true)
            <a href="{{route('locate')}}">Comenzar Ruta</a>
        @endif
        @if($userRol == true)
            <a href="{{route('bus-stop.admin')}}">Agregar Parada</a>
            <a href="{{route('LinesAdmin')}}">Administrar Lineas</a>
            <a href="{{route('bus-stops.routes')}}">Administrar Rutas</a>
        @endif
        <a>
            Mostrar Paradas de Colectivo
            <input type="checkbox" id="mostrarParadas" value="" name="Paradas" class="check" onchange="sm()" checked>
        </a>
        <a>
            Mostrar Rutas de Colectivo
            <input type="checkbox" id="mostrarRutas" value="" name="Rutas" class="check" onchange="sr()" checked>
        </a>
        <a href="{{route('LinesView')}}">Lineas</a>
        <a href="{{route('dashboard')}}">Dashboard</a>
    </div>
    <script src="{{ asset('js\menu.js') }}"></script>

    <input type="hidden" id="busStops" value="{{$busStops}}">
    <input type="hidden" id="busRoutes" value="{{$rutas}}">
    <input type="hidden" id="paradaUser" value="{{$parada}}">
    <input type="hidden" id="paradasGuardadas" class="paradasGuardadas" value="{{$consulta}}">

    <div id="map"></div>

</body>
    <script src="{{ asset('js\index.js') }}"></script>
</html>
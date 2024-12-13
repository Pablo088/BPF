<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lines</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css\menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css\lines.css') }}">
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

         @if($userRol == true)
            <a href="{{route('bus-stop.admin')}}">Agregar Parada</a>
            <a href="{{route('bus-stops.routes')}}">Administrar Rutas</a>
            <a href="{{route('LinesAdmin')}}">Administrar Lineas</a>
        @endif
        <a href="{{route('dashboard')}}">Dashboard</a>
    </div>
    <script src="{{ asset('js\menu.js') }}"></script>
<div id="contenedor1">
    <table class="table">
        <thead>
            <tr class="table-primary">
                <th>Compañía</th> 
                <th>Linea</th>
                <th>Inicio</th>
                <th>Fin</th>
                <th style="display: none;">ID</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lines as $line)
            <tr class="table-secondary" data-line-id="{{ $line->id }}">
                <td id="texto">{{$line->BusCompany->company_name}}</td> 
                <td id="texto">{{$line->line_name}}</td>
                <td id="texto">{{$line->horario_comienzo}}</td>
                <td id="texto">{{$line->horario_finalizacion}}</td>
                <td style="display: none;">{{ $line->id }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="infoModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Información Detallada</h2>
        <p id="modalInfo">Detalles aquí...</p>
    </div>
</div>
<input type="hidden" id="lineId" value="{{ $id_line }}">
</body>
    <script src="{{ asset('js\lines.js') }}"></script>
</html>

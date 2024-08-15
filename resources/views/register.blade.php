<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css\menu.css') }}">
    <title>Registrarse</title>
</head>
<body>
    <div class="open-menu" onclick="openMenu()">&#9776;</div>
    <div id="overlay" class="overlay" onclick="closeMenu()"></div>

    <div id="menu" class="menu">
        <a href="javascript:void(0)" class="closebtn" onclick="closeMenu()">&times;</a>
        <a href="{{ route('bus-stops.index') }}">Inicio</a>
        <a href="{{route('login')}}">Iniciar sesión</a>
    </div>
    {{-- <a href="{{ route('bus-stops.index') }}" type='button'>Inicio</a> --}}
    <h2>Registrarse</h2>
        <form action="{{ route('dashboard') }}" method="POST">
            @csrf
            <input type="text" name="name" id="name" placeholder="Nombre">
            <input type="email" name="email" id="email" placeholder="Email">
            <input type="password" name="password" id="password" placeholder="Contraseña">
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmar contraseña">
            <button id="button" type="submit">Enviar</button>
        </form>
</body>
<script src="{{ asset('js\menu.js') }}"></script>
</html>
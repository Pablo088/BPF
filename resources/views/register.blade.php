<!DOCTYPE html>
<html lang="es">
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
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
    <h2 id='login'>Registrarse</h2>
        <form action="{{ route('dashboard') }}" method="POST">
            @csrf
            <div id="contenedor">
            <div class="form-floating mb-3">
            <input type="email" class="form-control" id="Name" name='Name' placeholder="Nombre">
            <label for="floatingInput">Name</label>
            </div>
            <div class="form-floating mb-3">
             <input type="text" class="form-control" id="floatingInput" name='Email' placeholder="Direccion de correo electronico">
            <label for="floatingInput">Email</label>
            </div>
            <div class="form-floating mb-3">
             <input type="password" class="form-control" id="floatingPassword" name='password' placeholder="Contraseña">
            <label for="floatingInput">Contraseña</label>
            </div>
            <div class="form-floating mb-3">
             <input type="password" class="form-control" id="password_confirmation" name='password_confirmation' placeholder="Confirmar contraseña">
            <label for="floatingInput">Confirmar contraseña</label>
            </div>
            <button id="button" type="submit">Enviar</button>
            </div>
        </form>
</body>
<script src="{{ asset('js\menu.js') }}"></script>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css\menu.css')}}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iniciar sesion</title>
    <style>
        #contenedor{
            position: absolute;
            top: 50%;
            right: 50%;
            transform: translate(50% , -50%);
            width: 43%;
            height: 60%;
            border-radius: 3%;
            border: solid 3px;
            border-color: 3px solid black;
            display: flex; 
            align-items: left; 
            flex-direction: column;
            justify-content: center; 
            background-color: rgba(136, 136, 136, 0.589);
            padding-left: 2%;
        }
        #contenedor .form-control {
        width: 90%;
        height: 50px;
        }

        #button{
            background-color: rgba(81, 29, 204, 0.589);
        }

        #login{
            position: absolute;
            top: 10%;
            right: 43%;
        }       
        #register{
            position: absolute;
            top: 70%;
            right: 34%; 
        }
       

    </style>
</head>
<body>
    <div class="open-menu" onclick="openMenu()">&#9776;</div>
    <div id="overlay" class="overlay" onclick="closeMenu()"></div>

    <div id="menu" class="menu">
        <a href="javascript:void(0)" class="closebtn" onclick="closeMenu()">&times;</a>
        <a href="{{ route('bus-stops.index') }}">Inicio</a>
        <a href="{{route('register')}}">Registrarse</a>
    </div>
    <h1 id='login'>Iniciar sesión</h1>
    <form action="{{ route('login.validate') }}" method="post">
        @csrf
        <div id="contenedor">
       <div class="form-floating mb-3">
        <input type="email" class="form-control" id="floatingInput" name='email' placeholder="Direccion de correo electronico" required>
        <label for="floatingInput">Email</label>
        </div>
        <div class="form-floating mb-3">
        <input type="password" class="form-control" id="floatingInputPassword" name='password' placeholder="Contraseña" required>
        <label for="floatingInputPassword">Contraseña</label>
        </div>
        <button id="button" class="form-control" type="submit">Enviar</button>
        </div>
    </form>
    @if (session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning text-center">
            {{ session('warning') }}
        </div>
    @endif

    <a href="{{ route('register') }}"class="btn btn-success" id="register">Registrarse</a>

    {{-- <a href="{{ route('bus-stops.index') }}" type='button'>Inicio</a> --}}
    {{-- <a>||</a>
    <a href="{{ route('register') }}" type='button'>Registrarse</a> --}}
    <script src="{{ asset('js\menu.js') }}"></script>
</body>
</html>
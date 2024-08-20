<!DOCTYPE html>
<html lang="es">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css\menu.css') }}">
    <title>Registrarse</title>
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
            right: 45%;
        }
    </style>
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
                <input type="text" class="form-control" id="floatingInputName" name='Name' placeholder="Nombre" required>
                <label for="floatingInputName">Name</label>
                </div>
                <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingInput" name='Email' placeholder="Direccion de correo electronico" required>
                <label for="floatingInput">Email</label>
                </div>
                <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingInputPassword" name='password' placeholder="Contraseña" required>
                <label for="floatingInputPassword">Contraseña</label>
                </div>
                <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingInputconfirmation" name='password_confirmation' placeholder="Confirmar contraseña" required>
                <label for="floatingInputconfirmation">Confirmar contraseña</label>
                </div>
            <button id="button" class="form-control" type="submit">Enviar</button>
            </div>
           
    </form>
</body>
<script src="{{ asset('js\menu.js') }}"></script>
</html>
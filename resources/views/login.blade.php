<!DOCTYPE html>
<html lang="es">
<head>
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iniciar sesion</title>
    <style>
        #login{
            position: absolute;
            top: 10%;
            right: 47%;
            transform: translate(50% , -50%); 
            /* box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.5); */
            width: 20%;
            height: 4%;
        }
        #email{
            position: absolute;
            top: 35%;
            right: 50%;
            transform: translate(50% , -50%); 
            box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.5);
            width: 23%;
            height: 6%;
        }
        #password{
            position: absolute;
            top: 50%;
            right: 50%;
            transform: translate(50% , -50%); 
            box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.5);
            width: 23%;
            height: 6%;
        }
        #button{
            position: absolute;
            top: 68%;
            right: 50%;
            transform: translate(50% , -50%); 
            width: 23%;
            height: 10%;
            border-radius: 3%;
            border: solid 2px;
            border-color: 3px solid black;
            cursor: pointer;
        }

        #contenedor{
            position: absolute;
            top: 35%;
            right: 50%;
            transform: translate(50% , -50%);
            width: 43%;
            height: 50%;
            border-radius: 3%;
            border: solid 3px;
            border-color: 3px solid black;
            display: flex; 
            align-items: center; 
            justify-content: center; 
            background-color: rgba(167, 27, 209, 0.589);
        }
        #register{
            position: absolute;
            top: 50%;
            right: 35%;
        }
       

    </style>
</head>
<body>
    <h1 id='login'>Iniciar sesión</h1>
    <form action="{{ route('dashboard') }}" method="POST">
        @csrf
        <div id="contenedor">
       {{--  <h2>Iniciar sesion</h2> --}}
        <input type="email" name="email" id="email" placeholder="Email">
        <input type="password" name="password" id="password" placeholder="Contraseña">
        <button id="button" type="submit">Enviar</button>
        </div>
    </form>

    <a href="{{ route('register') }}" id="register">Registrarse</a>

    <a href="{{ route('bus-stops.index') }}" type='button'>Inicio</a>
    <a>||</a>
    <a href="{{ route('register') }}" type='button'>Registrarse</a>
</body>
</html>
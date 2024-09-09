<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lines</title>
    <link rel="stylesheet" href="{{ asset('css\menu.css') }}">
    <style>
        #contenedor1{
            
            position: absolute;
            top: 50%;
            right: 80%;
            transform: translate(50% , -50%);
            width: 33%;
            height: 80%;
            border-radius: 3%;
            border: solid 3px;
            border-color: 3px solid black;
            margin: auto;
            display: flex; 
            align-items: center; 
            justify-content: center; 
            
        }
    </style>
</head>
<body>
<div class="open-menu" onclick="openMenu()">&#9776;</div>
    <div id="overlay" class="overlay" onclick="closeMenu()"></div>

    <div id="menu" class="menu">
        <a href="javascript:void(0)" class="closebtn" onclick="closeMenu()">&times;</a>
        <a href="{{ route('login') }}">Iniciar sesión</a>
        <a href="{{route('register')}}">Registrarse</a>
        @can('bus-stop.admin')
            <a href="{{route('bus-stop.admin')}}">Agregar Parada</a>    
            <a href="{{route('bus-stop.routes')}}">Agregar Rutas</a>
        @endcan
        <a>
            Mostrar Paradas de Colectivo
            <input type="checkbox" id="mostrarParadas" value="" name="Paradas" class="check" onchange="sm()" checked> 
        </a>
    </div>
    <script src="{{ asset('js\menu.js') }}"></script>
    <script>
        function permiso(){
            let respuesta = confirm('¿Queres agregar una parada?');

            if(respuesta == true){
                return true;
            } else {
                return false;
            }
        }
    </script>

<div id="contenedor1">
        <div>
            <table>
                <th>
                
                </th>
            </table>
        </div>
</div>

    
</body>
</html>

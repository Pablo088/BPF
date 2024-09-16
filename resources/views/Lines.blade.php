<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lines</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
            justify-content: left; 
            background-color: rgba(209, 27, 42, 0.719);
            
            
        }
        #texto{
            cursor: pointer;
            

        }
    .modal {
    display: none; /* Oculto por defecto */
    position: fixed;
    z-index: 1000; /* En la parte superior */
    left: 68%;
    top: 50%;
    transform: translate(-50%, -50%);
    width: 60%; /* Ancho completo */
    height: auto; /* Alto completo */
    max-height: 80%;
    overflow: auto; /* Agregar scroll si es necesario */
    background-color: rgb(0,0,0); /* Color de fondo con opacidad */
    background-color: rgba(0,0,0,0.4); /* Fondo negro con opacidad */
}

.modal-content {
    background-color: #fefefe;
    margin: 15% auto; /* Márgenes automáticos para centrar */
    padding: 20px;
    border: 1px solid #888;
    width: 96%; /* Ancho del modal */
    height: 60%;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
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
    <table class="table">
        <thead>
            <tr class="table-primary">
                <th>Compañía</th> 
                <th>Linea</th>
                <th>horarios</th>
                <th style="display: none;">ID</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lines as $line)
            <tr class="table-secondary">
                <td id="texto">{{$line->BusCompany->company_name}}</td> 
                <td id="texto">{{$line->line_name}}</td>
                <td id="texto">{{$line->horarios}}</td>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    const rows = document.querySelectorAll('.table-secondary');
    const modal = document.getElementById('infoModal');
    const closeModal = document.querySelector('.close');
    const modalInfo = document.getElementById('modalInfo');

    rows.forEach(row => {
    row.addEventListener('click', function() {
        const id = this.querySelector('td:nth-child(4)').textContent;
        fetch(`/Lines/buscar/${id}`)
            .then(response => {
                return response.json();
            })
            .then(data => {
                let stopsInfo = '';

                // Iterar sobre las paradas de autobús (busStops)
                data.bus_stops.forEach(stop => {
                    stopsInfo += `
                        <strong>Dirección de la parada:</strong> ${stop.direction} <br>
                        <strong>Latitud:</strong> ${stop.latitude} <br>
                        <strong>Longitud:</strong> ${stop.longitude} <br><br>
                    `;
                });

                
                modalInfo.innerHTML = `
                    <strong>Nombre de la línea:</strong> ${data.line_name} <br>
                    <strong>Horario:</strong> ${data.horarios} <br><br>
                    ${stopsInfo}
                `;
                modal.style.display = 'block';
            });
    });
});

    closeModal.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});
</script>
    
</body>
</html>

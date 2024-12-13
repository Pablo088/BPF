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
            overflow-y: hidden;
            top: 50%;
            right: 77%;
            transform: translate(50% , -50%);
            width: 40%;
            height: auto;
            border-radius: 3%;
            border: solid 3px;
            border-color: 3px solid black;
            margin: auto;
            display: flex; 
            align-items: center; 
            justify-content: left; 
            background-color: #e2e3e5;
            
            
        }
        #texto{
            cursor: pointer;
            

        }
    .modal {
    display: none; /* Oculto por defecto */
    position: fixed;
    z-index: 1000; /* En la parte superior */
    left: 70%;
    top: 50%;
    transform: translate(-50%, -50%);
    width: 50%; /* Ancho completo */
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

/* Resto de tus estilos actuales */

.table tbody tr {
    transition: all 0.3s;
}

.table tbody tr.highlight {
    background-color: #0d6efd !important;
    color: #ffffff !important;
}

.table tbody tr.highlight td {
    background-color: #0d6efd !important;
    color: #ffffff !important;
}
    </style>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    const rows = document.querySelectorAll('.table-secondary');
    const modal = document.getElementById('infoModal');
    const closeModal = document.querySelector('.close');
    const modalInfo = document.getElementById('modalInfo');

    function loadAndShowLineData(lineId, clickedRow) {
        // Remover highlight de todas las filas
        document.querySelectorAll('.table tbody tr').forEach(row => {
            row.classList.remove('highlight');
        });
        
        // Agregar highlight a la fila seleccionada
        clickedRow.classList.add('highlight');

        fetch(`/Lines/buscar/${lineId}`)
            .then(response => response.json())
            .then(data => {
                let stopsInfo = '';
                if (data && data.bus_stops) {
                    data.bus_stops.forEach(stop => {
                        stopsInfo += `
                            <strong>Dirección de la parada:</strong> ${stop.direction} <br>
                            <strong>Latitud:</strong> ${stop.latitude} <br>
                            <strong>Longitud:</strong> ${stop.longitude} <br><br>
                        `;
                    });
                }

                modalInfo.innerHTML = `
                    <strong>Nombre de la línea:</strong> ${data.line_name} <br>
                    <strong>Horario Comienzo:</strong> ${data.horario_comienzo} <br>
                    <strong>Horario Finalización:</strong> ${data.horario_finalizacion} <br><br>
                    ${stopsInfo}
                `;
                modal.style.display = 'block';
            });
    }

    // Manejar el parámetro de la URL
    const urlParams = new URLSearchParams(window.location.search);
    const lineIdFromUrl = urlParams.get('line');
    console.log('ID recibido:', lineIdFromUrl);
    if (lineIdFromUrl) {
        const row = document.querySelector(`[data-line-id="${lineIdFromUrl}"]`);
        if (row) {
            loadAndShowLineData(lineIdFromUrl, row);
        }
    }

    rows.forEach(row => {
        row.addEventListener('click', function() {
            const id = this.querySelector('td:last-child').textContent;
            loadAndShowLineData(id, this);
        });
    });

    // Cerrar modal
    closeModal.addEventListener('click', () => modal.style.display = 'none');
    window.addEventListener('click', (event) => {
        if (event.target === modal) modal.style.display = 'none';
    });
});
</script>
</body>
</html>

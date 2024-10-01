<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paradas de Colectivo</title>
    <link rel="stylesheet" href="{{ asset('css\menu.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" />
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> --}}
    <style>
        .leaflet-top.leaflet-left {
            left: 95vw; /* Ajusta este valor según el ancho de tu menú */
        }

        #map { height: 600px; }
        
        #eliminar {
        color: white;
        background-color: #ff0000;
        border-color: #ff0000;
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        }
        #editar{
        color: white;
        background-color: #007bff;
        border-color: #007bff;
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        text-align: right;
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
      
        <a href="{{route('LinesView')}}">Lineas</a>
        <a>
            Mostrar Paradas de Colectivo
            <input type="checkbox" id="mostrarParadas" value="" name="Paradas" class="check" onchange="sm()" checked> 
        </a>
        <a>
            Mostrar Rutas de Colectivo
            <input type="checkbox" id="mostrarRutas" value="" name="Rutas" class="check" onchange="sr()" checked> 
        </a>
    </div>

    <input type="hidden" id="busStops" value="{{$busStops}}">

    <div id="map"></div>

    <form method="POST" action="{{route('bus-stops.store')}}">
        @csrf
        <label for="name">Nombre:</label>
        <input type="text" id="direction" name="direction" value = "direction" required>
        <label for="latitude">Latitud:</label>
        <input type="text" id="latitude" name="latitude" value = "laitude" required>
        <label for="longitude">Longitud:</label>
        <input type="text" id="longitude" name="longitude" value= "longitude" required>
        <button type="submit">Añadir Parada</button>
    </form>
    {{-- <form method="POST" action="{{route('bus-stops.routes')}}">
        @csrf
        <label for="road_group">Conjunto ruta:</label>
        <input type="text" id="road_group" name="road_group" required>

        <label for="latitude">Latitud:</label>
        <input type="text" id="latitude" name="laitude" required>

        <label for="longitude">Longitud:</label>
        <input type="text" id="longitude"  name="longitude" required>

        <label for="orden">orden:</label>
        <input type="text" id="order"  name="order" required>

        <label for="color">color:</label>
        <input type="text" id="color"  name="color" required>

        <button type="submit">Añadir Ruta</button>
    </form> --}}

    <script src="{{ asset('js\menu.js') }}"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>
    
    
    <script>
    const busStops = JSON.parse(document.getElementById('busStops').value);
    const map = L.map('map').setView([-33.009668, -58.521428], 14);
    let checkbox = document.getElementById('mostrarParadas');
    
    //console.log(busStops);
    const listaParadas = document.getElementById('listaParadas');

    L.tileLayer('https://wms.ign.gob.ar/geoserver/gwc/service/tms/1.0.0/capabaseargenmap@EPSG%3A3857@png/{z}/{x}/{-y}.png', {
        maxZoom: 20,
    }).addTo(map);

    const busStopIcon = L.icon({
        iconUrl: '/Icono_paradas.png',
        iconSize: [20, 20],
        iconAnchor: [10, 10],
    });

    var markers = L.markerClusterGroup({
    disableClusteringAtZoom: 16 // Deshabilita el agrupamiento a partir del nivel de zoom 17
});


    function addMarkers() {
        busStops.forEach(busStop => {
            const marker = L.marker([busStop.latitude, busStop.longitude], {icon: busStopIcon})
            .bindPopup(`
                <b>${busStop.direction ? busStop.direction : 'Parada sin nombre'}</b><br>
                Latitud: ${busStop.latitude}<br>
                Longitud: ${busStop.longitude}<br>
                ID: ${busStop.id}<br>
                <br>
                <a href="/bus-stops/admin/eliminar/${busStop.id}" id=eliminar > Eliminar </a>
                <a href="/bus-stops/admin/editar/${busStop.id}" id=editar > Editar </a>
            `);
            markers.addLayer(marker); // Añadir cada marcador al grupo de clusters
        });
        map.addLayer(markers); // Añadir el grupo de clusters al ma
    }

    function removeMarkers() {
        markers.clearLayers(); // Remover todas las capas del grupo de clusters
    }

    

    //removeDefaultMarkers();
    addMarkers();
     
    function sm() {
    if (checkbox.checked) {
        addMarkers();
    } else {
       removeMarkers();
    }
}

    map.on('contextmenu', function(ev) {
    
    var latitude = ev.latlng.lat;
    var longitude = ev.latlng.lng;
    var popupContent = `
        <div>
            <p>Coordenadas: ${latitude}, ${longitude}</p>
            <button id="copiarBtn" onclick="copiarCoordenadas(${latitude}, ${longitude})">Copiar Coordenadas</button>
        </div>
    `;
    L.popup()
        .setLatLng(ev.latlng)
        .setContent(popupContent)
        .openOn(map);
    document.getElementById("latitude").value = latitude;
    document.getElementById("longitude").value = longitude;
   });


   function copiarCoordenadas(lat, lng) {
    var coordenadas = lat + ", " + lng;

    var tempInput = document.createElement("input");
    document.body.appendChild(tempInput);
    tempInput.value = coordenadas;
    tempInput.select();
    document.execCommand("copy");
    document.body.removeChild(tempInput);
}

   var callesSeleccionadas = [];
    map.on('click', function(e) {
            // Obtener las coordenadas donde se hizo clic
            var latlng = e.latlng;

            var url = 'https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=' + latlng.lat + '&lon=' + latlng.lng;
            
            // Realizar la solicitud HTTP
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    // Obtener la dirección del resultado
                    var calle = data.address.road;
                    //alert(calle);

                    callesSeleccionadas.push(calle);
                    

                    console.log(callesSeleccionadas);
                    //console.log(data);
                    
                    // Mostrar la dirección en un alert
                    
                    for (var i = 0; i < callesSeleccionadas.length; i++) {
                        document.getElementById("direction").value = callesSeleccionadas[i-1] + " y " + callesSeleccionadas[i];
                    }
                    

                    

                })
                .catch(error => {
                    console.error('Error al obtener la dirección:', error);
                }); 
        });
    </script>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</body>
</html>
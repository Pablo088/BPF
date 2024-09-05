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
        <a href="{{ route('login') }}">Iniciar sesión</a>
        <a href="{{route('register')}}">Registrarse</a>
        <a>
            Mostrar Paradas de Colectivo
            <input type="checkbox" id="mostrarParadas" value="" name="Paradas" class="check" onchange="sm()" checked> 
        </a>
    </div>

    <input type="hidden" id="busStops" value="{{$busStops}}">

    <div id="map"></div>

    {{-- <form method="POST" action="{{route('bus-stops.store')}}">
        @csrf
        <label for="name">Nombre:</label>
        <input type="text" id="direction" name="direction" value = "direction" required>
        <label for="latitude">Latitud:</label>
        <input type="text" id="latitude" name="latitude" value = "laitude" required>
        <label for="longitude">Longitud:</label>
        <input type="text" id="longitude" name="longitude" value= "longitude" required>
        <button type="submit">Añadir Parada</button>
    </form> --}}
    <form method="POST" action="{{route('bus-stops.storeroutes')}}">
        @csrf
        <label for="road_group">Conjunto ruta:</label>
        <input type="number" id="road_group" name="road_group" required>

        <label for="latitude"></label>
        <input type="hidden" id="latitude" name="latitude[]" required>

        <label for="longitude"></label>
        <input type="hidden" id="longitude"  name="longitude[]" required>

        {{-- <label for="orden">orden:</label>
        <a type="text" id="order"  name="order" required> --}}

        <label for="puntos">Puntos seleccionados:</label>
        <a id="puntos"></a>
        <button type="submit">Añadir Ruta</button>
    </form>

    <script src="{{ asset('js\menu.js') }}"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>
    
    
    <script>
    const busStops = JSON.parse(document.getElementById('busStops').value);
    var rutas = <?php echo $rutas; ?>;
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

   var routelat = [];
   var routelong = [];
   var cantidadrutas = 0;
    map.on('click', function(e) {
            // Obtener las coordenadas donde se hizo clic
            var latlng = e.latlng;

            var rlat=latlng.lat;
            var rlong=latlng.lng;
            cantidadrutas = cantidadrutas+1;

            routelat.push(rlat);
            routelong.push(rlong);

            

            console.log(routelat);
            console.log(routelong);
            console.log(cantidadrutas);

            document.getElementById("puntos").innerHTML= cantidadrutas;
        });

        document.querySelector('form').addEventListener('submit', function(e) {
                e.preventDefault(); // Prevenir el envío por defecto del formulario
                
                var form = this;
                routelat.forEach(function(lat, index) {
                    var latInput = document.createElement('input');
                    latInput.type = 'hidden';
                    latInput.name = 'latitude[]';
                    latInput.value = lat;
                    form.appendChild(latInput);
                });
                
                routelong.forEach(function(long, index) {
                    var longInput = document.createElement('input');
                    longInput.type = 'hidden';
                    longInput.name = 'longitude[]';
                    longInput.value = long;
                    form.appendChild(longInput);
                });
                
                form.submit();
            });
        


        let color;
        rutas.forEach(ruta => {
            console.log(ruta);

        switch(ruta.nombre){
            case 1:
            color= 'blue';
            break;
            case 2: 
            color= 'red';
            break;
            case 3:
            color = 'green'; // Green: #00FF00
            break;
            case 4:
            color = 'orange'; // Bright Orange: #FFA500
            break;
            case 5:
            color = 'purple'; // Bright Purple: #8A2BE2
            break;
            case 6:
            color = 'teal'; // Teal: #008080
            break;
            case 7:
            color = 'salmon'; // Salmon: #FA8072
            break;
            case 8:
            color = 'yellow'; // Yellow: #FFFF00
            break;
            case 9:
            color = 'cian'; // cian: #00FFFF
            break;
                
        }

        console.log(`Color para la ruta ${ruta.nombre}: ${color}`);

    var polyline = L.polyline(ruta.coordenadas, {
    color: color,
    weight: 4,
    opacity: 1,
    smoothFactor: 1,
    })
    
    .bindPopup(`
    <div>
        <p>Esta es la ruta: ${ruta.nombre}</p>
        <button onclick="eliminarRuta(${ruta.nombre})">Eliminar Ruta</button>
    </div>`
    )
    .addTo(map);

    });
    </script>
</body>
</html>

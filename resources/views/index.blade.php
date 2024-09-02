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
    <style>
        .leaflet-top.leaflet-left {
            left: 95vw; /* Ajusta este valor según el ancho de tu menú */
        }

        #map { height: 640px; }

        #searchContainer {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 1000; /* Asegura que esté encima del mapa */
            background: white;
            padding: 5px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        #searchInput {
            width: 200px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .suggestions-list {
            position: absolute;
            top: 50px;
            right: 50%;
            width: 100%;
            background: white;
            border: 1px solid #ccc;
            max-height: 200px;
            overflow-y: auto;
            z-index: 1000;
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .suggestions-list li {
            padding: 8px;
            cursor: pointer;
        }
        .suggestions-list li:hover {
            background: #f0f0f0;
        }
    </style>
</head>
<body>
    {{-- <button onclick="showMyLocation()">Mostrar mi ubicación</button> --}}

    <div class="open-menu" onclick="openMenu()">&#9776;</div>
    <div id="overlay" class="overlay" onclick="closeMenu()"></div>

    <!-- para buscar las pardas  -->
    <div id="searchContainer">
            <input type="text" id="searchInput" placeholder="Buscar parada...">
            <ul id="suggestions" class="suggestions-list"></ul>
    </div>

    <div id="menu" class="menu">
        <a href="javascript:void(0)" class="closebtn" onclick="closeMenu()">&times;</a>
        <a href="{{ route('login') }}">Iniciar sesión</a>
        <a href="{{route('register')}}">Registrarse</a>
        {{-- <form action="{{route('bus-stop.admin')}}" method="GET">
            <button type="submit">Editar paradas</button>
        </form> --}}
        <a href="{{route('bus-stop.admin')}}">Agregar Parada</a>
        <a>
            Mostrar Paradas de Colectivo
            <input type="checkbox" id="mostrarParadas" value="" name="Paradas" class="check" onchange="sm()" checked> 
        </a>
        <a href="{{route('logout')}}">Cerrar sesion</a>
        
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
    
    <input type="hidden" id="busStops" value="{{$busStops}}">
    


    
    {{-- <a href="{{route('bus-stop.admin')}}"><button onclick="return permiso()">Agregar Parada</button></a> --}}

    {{-- <label>
        Mostrar Paradas de Colectivo
        <input type="checkbox" id="mostrarParadas" value="" name="Paradas" class="check" onchange="sm()" checked> 
    </label> --}}
    <div id="map"></div>


    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>
    
    <script>
        const busStops = JSON.parse(document.getElementById('busStops').value);
        var rutas = <?php echo $rutas; ?>;
        const map = L.map('map').setView([-33.009668, -58.521428], 14);
        let checkbox = document.getElementById('mostrarParadas');
        let locationActive = false;
        let userMarker = null;
        

        
        //console.log(busStops);
        //const listaParadas = document.getElementById('listaParadas');

        L.tileLayer('https://wms.ign.gob.ar/geoserver/gwc/service/tms/1.0.0/capabaseargenmap@EPSG%3A3857@png/{z}/{x}/{-y}.png', {
            maxZoom: 20,
        }).addTo(map);

        const busStopIcon = L.icon({
            iconUrl: 'Icono_paradas.png',
            iconSize: [20, 20],
            iconAnchor: [10, 10],
        });

        var markers = L.markerClusterGroup({
            disableClusteringAtZoom: 16
        });

        function addMarkers() {
            busStops.forEach(busStop => {
                const marker = L.marker([busStop.latitude, busStop.longitude], {icon: busStopIcon})
                .bindPopup(`
                    <b>${busStop.direction ? busStop.direction : 'Parada sin nombre'}</b><br>
                    Latitud: ${busStop.latitude}<br>
                    Longitud: ${busStop.longitude}<br>
                    ID: ${busStop.id}<br>
                `);
                markers.addLayer(marker); // Añadir cada marcador al grupo de clusters
            });
            map.addLayer(markers); // Añadir el grupo de clusters al mapa
        }

        function removeMarkers() {
            markers.clearLayers(); // Remover todas las capas del grupo de clusters
        }

        addMarkers();
        
        function sm() {
            if (checkbox.checked) {
                addMarkers();
            } else {
                removeMarkers();
            }
        }

        const userLocationIcon = L.icon({
            iconUrl: 'Icono_ubicacion.png',
            iconSize: [25, 25],
            iconAnchor: [16, 32],
            popupAnchor: [0, -32]
        });

        
        L.Control.LocationButton = L.Control.extend({
            onAdd: function(map) {
                var button = L.DomUtil.create('button', 'leaflet-bar leaflet-control leaflet-control-custom');
                button.innerHTML = '📍'; // Puedes usar un icono o texto
                button.style.backgroundColor = 'white';
                button.style.width = '30px';
                button.style.height = '30px';
                
                L.DomEvent.on(button, 'click', function() {
                    if (locationActive) {
                        removeCurrentLocation();
                        locationActive = false;
                        button.style.backgroundColor = 'white';
                        
                    }else{
                        showMyLocation();
                        locationActive = true;
                        button.style.backgroundColor = locationActive ? 'lightblue' : 'white';
                    }
                    
                });
                
                return button;
            }
        });

        L.control.locationButton = function(opts) {
            return new L.Control.LocationButton(opts);
        }

        L.control.locationButton({ position: 'bottomright' }).addTo(map);

        

        function showMyLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;

                        if (userMarker) {
                            removeCurrentLocation()
                        }

                        userMarker = L.marker([lat, lng], {icon: userLocationIcon}).addTo(map)
                            .bindPopup('Estás aquí');

                        var zoomvalue = map.getZoom();
                        
                        if (zoomvalue > 16) {
                            map.setView([lat, lng]);
                        }else{
                            map.setView([lat, lng], 16);
                        }
                        
                        locationActive = true;
                    },
                    function(error) {
                        console.error('Error al obtener la ubicación: ', error);
                        alert('No se pudo obtener la ubicación.');
                    }
                );
            } else {
                alert('La geolocalización no es soportada por este navegador.');
            }
        }


        function removeCurrentLocation() {
            if (userMarker) {
                map.removeLayer(userMarker);
                userMarker = null;
                //console.log("ejecutando");
            }
            

            
            //map.setView([-33.009668, -58.521428], 14);
        }
       


        const searchInput = document.getElementById('searchInput');
        const suggestions = document.getElementById('suggestions');

        searchInput.addEventListener('input', function() {
            const query = searchInput.value.toLowerCase();
            suggestions.innerHTML = '';

            if (query.length > 0) {
                const filteredStops = busStops.filter(busStop =>
                    busStop.direction && busStop.direction.toLowerCase().includes(query)
                );

                filteredStops.forEach(busStop => {
                    const li = document.createElement('li');
                    li.textContent = `${busStop.direction} (ID: ${busStop.id})`;
                    li.addEventListener('click', () => {
                        map.setView([busStop.latitude, busStop.longitude], 16);
                        removeMarkers(); // Opcional, dependiendo si quieres limpiar los marcadores existentes
                        addMarkers(); // Opcional, si quieres volver a mostrar todos los marcadores
                        searchInput.value = busStop.direction;
                        suggestions.innerHTML = '';
                    });
                    suggestions.appendChild(li);
                });
            }
        });
    rutas.forEach(ruta => {
    var polyline = L.polyline(ruta.coordenadas, {
        color: 'blue',
        weight: 3,
        opacity: 0.7,
        smoothFactor: 1
    })
    .bindPopup(`Esta es la ruta: ${ruta.nombre}`)
    .addTo(map);
    });
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paradas de Colectivo</title>
    <link rel="stylesheet" href="{{ asset('css\menu.css') }}">
    {{-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" /> --}}
    <link rel="stylesheet" href="{{ asset('css\leaflet.css') }}">
    {{-- <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" /> --}}
    <link rel="stylesheet" href="{{ asset('css\MarkerCluster.css') }}">
    {{-- <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" /> --}}
    <link rel="stylesheet" href="{{ asset('css\MarkerCluster.Default.css') }}">
    <style>
        .leaflet-top.leaflet-left {
            left: 96.1vw; /* Ajusta este valor según el ancho de tu menú */
            top: 500px;
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
            top: 2.5vw;
            right: 0.5vw;
            width: 92%;
            background: white;
            border: 1px solid white;
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

    <!-- para buscar las paradas  -->
    <div id="searchContainer">
            <input type="text" id="searchInput" placeholder="Buscar parada...">
            <ul id="suggestions" class="suggestions-list"></ul>
    </div>
    <div id="menu" class="menu">
        <a href="javascript:void(0)" class="closebtn" onclick="closeMenu()">&times;</a>
        @if ($userSession !== true)
            <a href="{{ route('login') }}">Iniciar sesión</a>
            <a href="{{route('register')}}">Registrarse</a>
        @endif
        @if($userRol == true)
            <a href="{{route('bus-stop.admin')}}">Agregar Parada</a>
            <a href="{{route('LinesAdmin')}}">Administrar Lineas</a>
            <a href="{{route('bus-stops.routes')}}">Administrar Rutas</a>
        @endif
        <a>
            Mostrar Paradas de Colectivo
            <input type="checkbox" id="mostrarParadas" value="" name="Paradas" class="check" onchange="sm()" checked> 
        </a>
        <a>
            Mostrar Rutas de Colectivo
            <input type="checkbox" id="mostrarRutas" value="" name="Rutas" class="check" onchange="sr()" checked> 
        </a>
        <a href="{{route('LinesView')}}">Lineas</a>
        <a href="{{route('dashboard')}}">Dashboard</a>
    </div>
    <script src="{{ asset('js\menu.js') }}"></script>

    <input type="hidden" id="busStops" value="{{$busStops}}">
    <input type="hidden" id="paradaUser" value="{{$parada}}">
    
    <div id="map"></div>

    {{-- <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script> --}}
    <script src="{{ asset('js\leaflet.js') }}"></script>
    {{-- <script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script> --}}
    <script src="{{ asset('js\leaflet.markercluster.js') }}"></script>

    <script>
        const busStops = JSON.parse(document.getElementById('busStops').value);
        var rutas = <?php echo $rutas; ?>;
        const map = L.map('map').setView([-33.009668, -58.521428], 14);
        const routes =  L.layerGroup()
        let checkboxP = document.getElementById('mostrarParadas');
        let checkboxR = document.getElementById('mostrarRutas');
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
                    <form method="post" action="{{route('bus-stop.store')}}" id="formCheck">
                        @csrf
                        <label>Me gusta <input type="checkbox" value="${busStop.id}" id="paradaSeleccionada" name="paradaId" onchange="guardarParada()"></label>
                    </form>
                `);
                markers.addLayer(marker); // Añadir cada marcador al grupo de clusters
            });
            map.addLayer(markers); // Añadir el grupo de clusters al mapa
        }
        function guardarParada(){
            let check = document.getElementById('paradaSeleccionada');
            let formCheck = document.getElementById('formCheck');
            if(check.checked){
                formCheck.submit();
            } 
        }

        function removeMarkers() {
            markers.clearLayers(); // Remover todas las capas del grupo de clusters
        }

        addMarkers();
        
        function sm() {
            if (checkboxP.checked) {
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
                        const myLocation = L.latLng(lat, lng);

                        if (userMarker) {
                            removeCurrentLocation()
                        }

                        userMarker = L.marker([lat, lng], {icon: userLocationIcon}).addTo(map)
                            .bindPopup('Estás aquí');

                        var zoomvalue = map.getZoom();
                        
                        if (zoomvalue > 18) {
                            map.setView([lat, lng]);
                        }else{
                            map.setView([lat, lng], 18);
                        }
                        
                        locationActive = true;

                        findNearestBusStop(myLocation);
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

    function findNearestBusStop(myLocation) {
    let nearestBusStop = null;
    let minDistance = Infinity;

    busStops.forEach(busStop => {
        const busStopLatLng = L.latLng(busStop.latitude, busStop.longitude);
        const distance = myLocation.distanceTo(busStopLatLng); // Calcula la distancia en metros

        if (distance < minDistance) {
            minDistance = distance;
            nearestBusStop = busStop;
        }
    });

    if (nearestBusStop) {
        // Crear un marcador en la parada más cercana
        const nearestMarker = L.marker([nearestBusStop.latitude, nearestBusStop.longitude], { icon: busStopIcon })
            .addTo(map)
            .bindPopup(`
                <b>${nearestBusStop.direction ? nearestBusStop.direction : 'Parada sin nombre'}</b><br>
                ID: ${nearestBusStop.id}<br>
                Distancia: ${Math.round(minDistance)} metros.
            `)

            setTimeout(function() {
                 nearestMarker.openPopup();  // Abre el popup automáticamente después de 3 segundos
            }, 1000);
           // .openPopup(); // Mostrar el pop-up inmediatamente
    }
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
                        map.setView([busStop.latitude, busStop.longitude], 19);
                        searchInput.value = busStop.direction;
                        suggestions.innerHTML = '';
                    });
                    suggestions.appendChild(li);
                });
            }
        });


        let color;
    function addRoutes(){  
        rutas.forEach(ruta => {
        
         switch(ruta.grupo){
            case 1:
            color= 'yellow'; // Yellow: #FFFF00 || 1A
            break;
            case 2: 
            color= 'red'; // Red: #FF0000 || 1B
            break;
            case 3:
            color = 'teal'; // Teal: #008080 || 4A
            break;
            case 4:
            color = 'orange'; // Bright Orange: #FFA500 || 4A1
            break;
            case 5:
            color = 'salmon'; // Salmon: #FA8072|| 4B
            break;
            case 6:
            color = 'blue'; // Blue: #0000FF || 2A
            break;
            case 7:
            color = 'purple'; // Bright Purple: #8A2BE2  || 2B
            break;
            case 8:
            color = 'green'; // Yellow: #FFFF00 || 5A - vuelta
            break;
            case 9:
            color = '#00FFFF' ; // cian: #00FFFF || 5A - ida
            break;
            case 10:
            color = 'pink'; // Pink: #FFC0CB || 5B - vuelta
            break;
            case 11:
            color = 'brown'; // Brown: #A52A2A || 5B - ida
            break;
        } 
        /* switch(ruta.grupo){
            case 1:
            color= '#F7E300'; // 1A
            break;
            case 2: 
            color= '#FFFF99'; // 1B
            break;
            case 3:
            color = '#FFD700'; // 4A
            break;
            case 4:
            color = '#FFCC00'; // 4A1
            break;
            case 5:
            color = '#FFAE42'; // 4B
            break;
            case 6:
            color = '#87CEEB'; // 2A
            break;
            case 7:
            color = '#003366'; // 2B
            break;
            case 8:
            color = '#32CD32'; // 5A - vuelta
            break;
            case 9:
            color = '#77DD77' ; // 5A - ida
            break;
            case 10:
            color = '#228B22'; // 5B - vuelta
            break;
            case 11:
            color = '#6B8E23'; // 5B - ida
            break;
        } */
        //console.log(`Color para la ruta ${ruta.nombre}: ${color}`);
    var idEmpresa = ruta.id_empresa
    var colorEmpresa = ruta.color;
    /* if (idEmpresa == 1){
        colorEmpresa= 'yellow';
    }else if (idEmpresa == 2){  
            colorEmpresa= 'blue';
        }else if (idEmpresa == 3){
            colorEmpresa= 'green';
    } */
    var polyline = L.polyline(ruta.coordenadas, {
    color: color,
    weight: 3,
    opacity: 0.7,
    smoothFactor: 1
    })
    
    .bindPopup(`<b>Esta es la linea: ${ruta.nombre}</b><br>
                Pertenece a la empresa: ${ruta.empresa}
                <div style="width: 20px; height: 20px; background-color: ${colorEmpresa};"></div>`)
    routes.addLayer(polyline)
    .addTo(map);
    })
    }
    
    addRoutes();
    var rutasCreadas = true;

    
    function sr() {
        map.eachLayer(function (layer) {
                    if (layer instanceof L.Polyline && !checkboxR.checked && rutasCreadas === true) {
                        routes.clearLayers();
                        console.log(routes);
                        rutasCreadas = false;
                    }else if(checkboxR.checked && rutasCreadas === false){
                        addRoutes();
                        console.log(routes);
                        rutasCreadas = true;
                    }
                });
    }  
    </script>
    @if (session('success'))
        <script>alert("{{session('success')}}")</script>
    @endif
    @if (session('error'))
        <script>alert("{{session('error')}}")</script>
    @endif
</body>
</html>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paradas de Colectivo</title>
    <link rel="stylesheet" href="{{ asset('css\menu.css') }}">
    {{--
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" /> --}}
    <link rel="stylesheet" href="{{ asset('css\leaflet.css') }}">
    {{--
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" /> --}}
    <link rel="stylesheet" href="{{ asset('css\MarkerCluster.css') }}">
    {{--
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" /> --}}
    <link rel="stylesheet" href="{{ asset('css\MarkerCluster.Default.css') }}">
    <style>
        .leaflet-top.leaflet-left {
            left: 96.1vw;
            /* Ajusta este valor según el ancho de tu menú */
            top: 500px;
        }

        #map {
            height: 640px;
        }

        #searchContainer {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 1000;
            /* Asegura que esté encima del mapa */
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

        //estrella de favoritos
        .star-checkbox {
            position: relative;
            cursor: pointer;
            display: inline-block;
        }

        .star-checkbox input {
            display: none;
            /* Oculta el checkbox original */
        }

        .star {
            display: inline-block;
            width: 20px;
            height: 20px;
            background-color: #ddd;
            /* Color de la estrella por defecto */
            clip-path: polygon(50% 0%,
                    61% 35%,
                    98% 35%,
                    68% 57%,
                    79% 91%,
                    50% 70%,
                    21% 91%,
                    32% 57%,
                    2% 35%,
                    39% 35%);

            transition: background-color 0.3s;
        }

        .star-checkbox input:checked+.star {
            background-color: #ffd700;
            /* Color de la estrella cuando está seleccionada */
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
        @if ($userDriver == true)
            <a href="{{route('locate')}}">Comenzar Ruta</a>
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
    <input type="hidden" id="paradasGuardadas" class="paradasGuardadas" value="{{$consulta}}">

    <div id="map"></div>

    {{--
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script> --}}
    <script src="{{ asset('js\leaflet.js') }}"></script>
    {{--
    <script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script> --}}
    <script src="{{ asset('js\leaflet.markercluster.js') }}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.8.0/sweetalert2.min.css"
        rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.8.0/sweetalert2.min.js"></script>

    <script>
        const busStops = JSON.parse(document.getElementById('busStops').value);
        let userStops = (document.getElementById('paradaUser').value !== '') ? JSON.parse(document.getElementById('paradaUser').value) : '';
        let paradasGuardadas = JSON.parse(document.getElementById('paradasGuardadas').value) ?? '';
        var rutas = <?php echo $rutas; ?>;
        const map = (userStops == "") ? L.map('map').setView([-33.009668, -58.521428], 14) : L.map('map').setView([userStops.latitude, userStops.longitude], 23);
        const routes = L.layerGroup()
        let checkboxP = document.getElementById('mostrarParadas');
        let checkboxR = document.getElementById('mostrarRutas');
        let locationActive = false;
        let userMarker = null;

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
            paradasGuardadas.forEach(function (paradas) {
                let id = paradas.stopId;
                const marker = L.marker([paradas.latitude, paradas.longitude], { icon: busStopIcon })
                    .bindPopup(`
                        <b>${paradas.direction ? paradas.direction : 'Parada sin nombre'}</b><br>
                        Latitud: ${paradas.latitude}<br>
                        Longitud: ${paradas.longitude}<br>
                        <div class="container text-center mt-5">
                            <label class="star-checkbox">Guardada <input type="checkbox" class="d-none" value="${paradas.stopId}" id="borrarParada" name="paradaId" onchange="eliminarParada()" checked><span class="star"></span></label>
                        </div> 
                    `);
                markers.addLayer(marker); // Añadir cada marcador al grupo de clusters
            });
            busStops.forEach(function (busStop) {

                const marker = L.marker([busStop.latitude, busStop.longitude], { icon: busStopIcon })
                    .bindPopup(`
                        <b>${busStop.direction ? busStop.direction : 'Parada sin nombre'}</b><br>
                        Latitud: ${busStop.latitude}<br>
                        Longitud: ${busStop.longitude}<br>
                        <div class="container text-center mt-5">
                            <form method="post" action="{{route('bus-stop.store')}}" id="formCheck">
                                @csrf
                                <label class="star-checkbox">Guardar <input type="checkbox" class="d-none" value="${busStop.id}" id="paradaSeleccionada" name="paradaId" onchange="guardarParada()"><span class="star"></span></label>
                            </form>
                        </div> 
                    `);
                markers.addLayer(marker); // Añadir cada marcador al grupo de clusters
            });
            map.addLayer(markers); // Añadir el grupo de clusters al mapa
        }
        function guardarParada() {
            let check = document.getElementById('paradaSeleccionada');
            let formCheck = document.getElementById('formCheck');
            if (check.checked == true) {
                formCheck.submit();
            }
        }
        function eliminarParada() {
            let check = document.getElementById('borrarParada');
            let formCheck = document.getElementById('checkDelete');
            formCheck.submit();
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
            onAdd: function (map) {
                var button = L.DomUtil.create('button', 'leaflet-bar leaflet-control leaflet-control-custom');
                button.innerHTML = '📍'; // Puedes usar un icono o texto
                button.style.backgroundColor = 'white';
                button.style.width = '30px';
                button.style.height = '30px';

                L.DomEvent.on(button, 'click', function () {
                    if (locationActive) {
                        removeCurrentLocation();
                        locationActive = false;
                        button.style.backgroundColor = 'white';

                    } else {
                        showMyLocation();
                        locationActive = true;
                        button.style.backgroundColor = locationActive ? 'lightblue' : 'white';
                    }

                });

                return button;
            }
        });

        L.control.locationButton = function (opts) {
            return new L.Control.LocationButton(opts);
        }

        L.control.locationButton({ position: 'bottomright' }).addTo(map);



        function showMyLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function (position) {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;
                        const myLocation = L.latLng(lat, lng);

                        if (userMarker) {
                            removeCurrentLocation()
                        }

                        userMarker = L.marker([lat, lng], { icon: userLocationIcon }).addTo(map)
                            .bindPopup('Estás aquí');

                        var zoomvalue = map.getZoom();

                        if (zoomvalue > 18) {
                            map.setView([lat, lng]);
                        } else {
                            map.setView([lat, lng], 18);
                        }

                        locationActive = true;

                        findNearestBusStop(myLocation);
                    },
                    function (error) {
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

                setTimeout(function () {
                    nearestMarker.openPopup();  // Abre el popup automáticamente después de 3 segundos
                }, 1000);
                // .openPopup(); // Mostrar el pop-up inmediatamente
            }
        }


        const searchInput = document.getElementById('searchInput');
        const suggestions = document.getElementById('suggestions');

        searchInput.addEventListener('input', function () {
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
        function addRoutes() {
            rutas.forEach(ruta => {
                var idEmpresa = ruta.id_empresa
                var colorEmpresa = ruta.color;
                var polyline = L.polyline(ruta.coordenadas, {
                    color: ruta.color,
                    weight: 4,
                    opacity: 1,
                    smoothFactor: 1
                })

                    .bindPopup(`<b>Esta es la linea: ${ruta.nombre}</b><br>
                Pertenece a la empresa: ${ruta.empresa}<br>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="${colorEmpresa}" class="bi bi-bus-front-fill" viewBox="0 0 16 16">
                    <path d="M16 7a1 1 0 0 1-1 1v3.5c0 .818-.393 1.544-1 2v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5V14H5v1.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2a2.5 2.5 0 0 1-1-2V8a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1V2.64C1 1.452 1.845.408 3.064.268A44 44 0 0 1 8 0c2.1 0 3.792.136 4.936.268C14.155.408 15 1.452 15 2.64V4a1 1 0 0 1 1 1zM3.552 3.22A43 43 0 0 1 8 3c1.837 0 3.353.107 4.448.22a.5.5 0 0 0 .104-.994A44 44 0 0 0 8 2c-1.876 0-3.426.109-4.552.226a.5.5 0 1 0 .104.994M8 4c-1.876 0-3.426.109-4.552.226A.5.5 0 0 0 3 4.723v3.554a.5.5 0 0 0 .448.497C4.574 8.891 6.124 9 8 9s3.426-.109 4.552-.226A.5.5 0 0 0 13 8.277V4.723a.5.5 0 0 0-.448-.497A44 44 0 0 0 8 4m-3 7a1 1 0 1 0-2 0 1 1 0 0 0 2 0m8 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0m-7 0a1 1 0 0 0 1 1h2a1 1 0 1 0 0-2H7a1 1 0 0 0-1 1"/>
                </svg>`)
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
                } else if (checkboxR.checked && rutasCreadas === false) {
                    addRoutes();
                    console.log(routes);
                    rutasCreadas = true;
                }
            });
        }  

        let busMarkers = {};

function actualizarPosicionesBuses() {
    fetch('/api/get-localizaciones')
        .then(response => response.json())
        .then(data => {
            data.forEach(loc => {
                const busId = loc.line_id;
                const position = [loc.latitude, loc.longitude];
                const color = loc.bus_line.color;

                //console.log(busId, position, color);
                if (busMarkers[busId]) {
                    busMarkers[busId].setLatLng(position);
                } else {
                    const customIcon = L.divIcon({
                        html: `<svg xmlns="http://www.w3.org/2000/svg" width="22" height="32" fill="${color}" stroke="black" stroke-width="0.35" class="bi bi-bus-front-fill" viewBox="0 0 16 16">
                            <path d="M16 7a1 1 0 0 1-1 1v3.5c0 .818-.393 1.544-1 2v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5V14H5v1.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2a2.5 2.5 0 0 1-1-2V8a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1V2.64C1 1.452 1.845.408 3.064.268A44 44 0 0 1 8 0c2.1 0 3.792.136 4.936.268C14.155.408 15 1.452 15 2.64V4a1 1 0 0 1 1 1zM3.552 3.22A43 43 0 0 1 8 3c1.837 0 3.353.107 4.448.22a.5.5 0 0 0 .104-.994A44 44 0 0 0 8 2c-1.876 0-3.426.109-4.552.226a.5.5 0 1 0 .104.994M8 4c-1.876 0-3.426.109-4.552.226A.5.5 0 0 0 3 4.723v3.554a.5.5 0 0 0 .448.497C4.574 8.891 6.124 9 8 9s3.426-.109 4.552-.226A.5.5 0 0 0 13 8.277V4.723a.5.5 0 0 0-.448-.497A44 44 0 0 0 8 4m-3 7a1 1 0 1 0-2 0 1 1 0 0 0 2 0m8 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0m-7 0a1 1 0 0 0 1 1h2a1 1 0 1 0 0-2H7a1 1 0 0 0-1 1"/>
                        </svg>`,
                        className: 'custom-div-icon',
                        iconSize: [32, 32],
                        iconAnchor: [16, 16]
                    });

                    busMarkers[busId] = L.marker(position, {icon: customIcon})
                        .bindPopup(`Línea: ${loc.bus_line.line_name}`)
                        .addTo(map);
                }
            });
        });
}

// Iniciar la actualización
setInterval(actualizarPosicionesBuses, 5000);
actualizarPosicionesBuses();

    </script>
    @if (session('success'))
        <script>
            swal({
                title: "Exito",
                text: "{{session('success')}}",
                type: "success"
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            swal({
                title: "Error",
                text: "{{session('error')}}",
                type: "warning"
            });

        </script>
    @endif
</body>

</html>
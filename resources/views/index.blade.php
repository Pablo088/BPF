<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paradas de Colectivo</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" />
    <style>
       body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .menu {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: -250px;
            background-color: #333;
            padding-top: 60px;
            transition: 0.3s;
            z-index: 1000;
        }

        .menu a {
            padding: 8px 16px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
            transition: 0.3s;
        }

        .menu a:hover {
            background-color: #575757;
        }

        .menu .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        .open-menu {
            font-size: 30px;
            cursor: pointer;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 2000;
            color: #333
            
            
            ;
        }

        .content {
            transition: margin-left 0.3s;
            padding: 16px;
            margin-left: 0;
            position: relative;
            z-index: 500;
        }

        /* Estilo para la capa oscura (overlay) */
        .overlay {
            height: 100%;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 900;
            opacity: 0;
            transition: opacity 0.3s;
            display: none;
            pointer-events: none; /* Desactiva la interacción */
        }

        /* Cuando el overlay está activo */
        .overlay.active {
            opacity: 1;
            display: block;
            pointer-events: auto; /* Activa la interacción */
        }

        /* Desactiva la interacción con el mapa cuando el menú está abierto */
        .map-container.inactive {
            pointer-events: none;
        }

        .leaflet-top.leaflet-left {
            left: 95vw; /* Ajusta este valor según el ancho de tu menú */
        }

        #map { height: 620px; }
    </style>
</head>
<body>
    <div class="open-menu" onclick="openMenu()">&#9776;</div>
    <div id="overlay" class="overlay" onclick="closeMenu()"></div>

    <div id="menu" class="menu">
        <a href="javascript:void(0)" class="closebtn" onclick="closeMenu()">&times;</a>
        <a href="{{ route('login') }}">Iniciar sesión</a>
        <a href="{{route('bus-stop.admin')}}" onclick="return permiso()">Agregar Parada</a>
        <a href="#">About Us</a>
    </div>
    <script>
        function openMenu() {
            document.getElementById("menu").style.left = "0";
            document.getElementById("overlay").classList.add("active");
            document.getElementById("map-container").classList.add("inactive");
        }

        function closeMenu() {
            document.getElementById("menu").style.left = "-250px";
            document.getElementById("overlay").classList.remove("active");
            document.getElementById("map-container").classList.remove("inactive");
        }
    </script>
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

    <label>
        Mostrar Paradas de Colectivo
        <input type="checkbox" id="mostrarParadas" value="" name="Paradas" class="check" onchange="sm()" checked> 
      </label>
    <div id="map"></div>


    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>
    
    <script>
        const busStops = JSON.parse(document.getElementById('busStops').value);
        const map = L.map('map').setView([-33.009668, -58.521428], 14);
        let checkbox = document.getElementById('mostrarParadas');
        
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

    </script>
</body>
</html>
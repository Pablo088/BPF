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
        #map { height: 500px; }
    </style>
</head>
<body>
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
    
    <form action="{{ route('login') }}" method="GET">
        <button type="submit">Iniciar sesion</button>
    </form>
    
    <a href="{{route('bus-stop.admin')}}"><button onclick="return permiso()">Agregar Parada</button></a>

    <label>
        Mostrar Paradas de Colectivo
        <input type="checkbox" id="mostrarParadas" value="" name="Paradas" class="check" onchange="sm()" checked> 
      </label>
    <div id="map"></div>


    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>
    
    <script>
        const busStops = @json($busStops);
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
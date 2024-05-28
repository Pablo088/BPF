<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paradas de Colectivo</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        #map { height: 500px; }
    </style>
</head>
<body>
    <h1>Paradas de Colectivo</h1>
    <div id="map"></div>

    <form method="POST" action="/bus-stops">
        @csrf
        <label for="name">Nombre:</label>
        <input type="text" id="direction" name="direction">
        <label for="latitude">Latitud:</label>
        <input type="text" id="latitude" name="latitude" required>
        <label for="longitude">Longitud:</label>
        <input type="text" id="longitude" name="longitude" required>
        <button type="submit">Añadir Parada</button>
    </form>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    
    <script>
    const busStops = @json($busStops);
    const map = L.map('map').setView([-33.009668, -58.521428], 14);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    const busStopIcon = L.icon({
        iconUrl: 'Icono_paradas.png',
        iconSize: [20, 20],
        iconAnchor: [0, 0],
    });

    let markers = [];

    
    function addMarkers() {
        busStops.forEach(busStop => {
            const marker = L.marker([busStop.latitude, busStop.longitude], {icon: busStopIcon})
                .bindPopup(busStop.direction ? busStop.direction : 'Parada sin nombre');
            markers.push(marker);
            marker.addTo(map);
        });
    }

    
    function removeMarkers() {
        markers.forEach(marker => {
            map.removeLayer(marker);
        });
        markers = [];
    }

    //addMarkers(); 

    map.on('zoomend', function() {
        
        if (map.getZoom() <= 15) {
            removeMarkers();
        } else {
            addMarkers(); 
        }
    });

    console.log(map);
</script>
</body>
</html>
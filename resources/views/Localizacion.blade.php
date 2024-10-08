<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaflet Location</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        #map {
            height: 600px;
            width: 100%;
        }
    </style>
</head>
<body>
    <h1>Ubicación Actual</h1>
    <div id="map"></div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        // Inicializar el mapa
        var map = L.map('map').setView([51.505, -0.09], 13);

        // Agregar las capas de mapas
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Obtener la ubicación del usuario y enviarla cada cierto tiempo
        function sendLocation(latitude, longitude) {
            fetch('/location', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    latitude: latitude,
                    longitude: longitude
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Location sent:', data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        // Vigilar la ubicación del usuario cada 5 segundos
        if (navigator.geolocation) {
            navigator.geolocation.watchPosition(function (position) {
                var lat = position.coords.latitude;
                var lon = position.coords.longitude;
                map.setView([lat, lon], 13);

                // Agregar un marcador en la ubicación
                L.marker([lat, lon]).addTo(map)
                    .bindPopup('Estás aquí!')
                    .openPopup();

                // Enviar la ubicación al servidor
                sendLocation(lat, lon);
            }, function () {
                alert('No se pudo obtener la ubicación');
            }, {
                enableHighAccuracy: true,
                timeout: 5000,
                maximumAge: 0
            });
        } else {
            alert('La geolocalización no es soportada por tu navegador.');
        }
    </script>
</body>
</html>

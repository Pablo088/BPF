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
    <h1>Ubicación Actual y Radio de Alerta</h1>
    <div id="map"></div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([51.505, -0.09], 13);

        // Agregar las capas de mapas
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        var userMarker;
        var userCircle;
        var radius = 500; // Radio de 500 metros
        var isOutsideCircle = false; // Para verificar si ya ha salido del círculo

        // Función para enviar la ubicación
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

        // Verifica si la ubicación está fuera del radio
        function checkDistance(lat, lon) {
            var currentLatLng = L.latLng(lat, lon);
            var circleLatLng = userCircle.getLatLng();
            var distance = currentLatLng.distanceTo(circleLatLng);

            if (distance > radius && !isOutsideCircle) {
                // El usuario sale del círculo y se envía la ubicación
                console.log(`Fuera del radio (${Math.round(distance)} metros). Enviando ubicación...`);
                sendLocation(lat, lon);
                isOutsideCircle = true; // Marca que ya salió del círculo

                // Actualizar el círculo y el marcador en la nueva ubicación
                updateCircle(lat, lon);
            } else if (distance <= radius) {
                // Si vuelve a entrar al círculo, se resetea
                isOutsideCircle = false;
            }
        }

        // Actualizar la ubicación del círculo y el marcador
        function updateCircle(lat, lon) {
            if (userMarker && userCircle) {
                // Mover el marcador a la nueva ubicación
                userMarker.setLatLng([lat, lon]);

                // Mover el círculo a la nueva ubicación
                userCircle.setLatLng([lat, lon]);
            } else {
                // Si no existe, crearlo
                userMarker = L.marker([lat, lon]).addTo(map)
                    .bindPopup('Estás aquí!')
                    .openPopup();

                userCircle = L.circle([lat, lon], {
                    color: 'blue',
                    fillColor: '#30f',
                    fillOpacity: 0.3,
                    radius: radius
                }).addTo(map);

                map.setView([lat, lon], 13);
            }
        }

        // Vigilar la ubicación del usuario
        if (navigator.geolocation) {
            navigator.geolocation.watchPosition(function (position) {
                var lat = position.coords.latitude;
                var lon = position.coords.longitude;

                if (!userMarker && !userCircle) {
                    // Inicializar el marcador y el círculo en la primera ubicación
                    updateCircle(lat, lon);
                } else {
                    // Comprobar si se sale del radio
                    checkDistance(lat, lon);
                }
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

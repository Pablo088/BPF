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
    <label>
        {{-- <input type="hidden" id="mostrarParadas" value = "0"> --}}
        <input type="checkbox" id="mostrarParadas" value="" name="Paradas" class="check">
        Mostrar Paradas de Colectivo
      </label>
    <div id="map"></div>

    <form method="POST" action="/bus-stops">
        @csrf
        <label for="name">Nombre:</label>
        <input type="text" id="direction" name="direction" value = "direction" required>
        <label for="latitude">Latitud:</label>
        <input type="text" id="latitude" name="latitude" value = "laitude" required>
        <label for="longitude">Longitud:</label>
        <input type="text" id="longitude" name="longitude" value= "longitude" required>
        <button type="submit">Añadir Parada</button>
    </form>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    
    <script>
    const busStops = @json($busStops);
    const map = L.map('map').setView([-33.009668, -58.521428], 14);
    let checkbox = document.getElementById('mostrarParadas');
    
    //const listaParadas = document.getElementById('listaParadas');

    L.tileLayer('https://wms.ign.gob.ar/geoserver/gwc/service/tms/1.0.0/capabaseargenmap@EPSG%3A3857@png/{z}/{x}/{-y}.png', {
        maxZoom: 20,
    }).addTo(map);

    const busStopIcon = L.icon({
        iconUrl: 'Icono_paradas.png',
        iconSize: [20, 20],
        iconAnchor: [10, 10],
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

    

    //removeDefaultMarkers();
    //addMarkers();
     

    map.on('zoomend', function() {
        
        if (map.getZoom() > 11 && checkbox.checked ) {
            addMarkers(); 
        } else {          
            removeMarkers();
        }
    });

        /* function toggleParadas(){
            //var check = "";
            if (checkbox.checked){
                removeMarkers();
            }else{
                addMarkers(); 
            }
            console.log(check);
        } */

    map.on('contextmenu', function(ev) {
    alert(ev.latlng); // ev is an event object (MouseEvent in this case)
    console.log(ev.latlng)
    var latitude = ev.latlng.lat;
    var longitude = ev.latlng.lng;
    document.getElementById("latitude").value = latitude;
    document.getElementById("longitude").value = longitude;
   });

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
</body>
</html>
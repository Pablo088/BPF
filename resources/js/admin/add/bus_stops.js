    const busStops = JSON.parse(document.getElementById('busStops').value);
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
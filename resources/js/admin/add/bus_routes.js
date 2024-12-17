    const busStops = JSON.parse(document.getElementById('busStops').value);
    var rutas = JSON.parse(document.getElementById('busRoutes').value);
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



    /* function updateContent() {
        $.ajax({
            url: 'tu-archivo-o-endpoint.html',
            success: function(data) {
                $('#content').html(data);
            },
            error: function() {
                console.error('Error al actualizar');
            }
        });
    } */

    function addMarkers() {
        busStops.forEach(busStop => {
            const marker = L.marker([busStop.latitude, busStop.longitude], {icon: busStopIcon})
            .bindPopup(`
                <input type="hidden" name="id_parada" id="id_parada" value="${busStop.id}">
                <b>${busStop.direction ? busStop.direction : 'Parada sin nombre'}</b><br>
                Latitud: ${busStop.latitude}<br>
                Longitud: ${busStop.longitude}<br>
                ID: ${busStop.id}<br>
                <br>
                <a href="/bus-stops/admin/eliminar/${busStop.id}" id=eliminar > Eliminar </a>
                <a href="/bus-stops/admin/editar/${busStop.id}" id=editar > Editar </a>
                <input type="button" name="relacionarP" id="relacionarP" onclick="relacionarParada()">Relacionar</input>
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
    }}

function sr() {
    if (checkbox.checked) {
        addMarkers();
    } else {
       removeMarkers();
    }}

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

    var routelat = [];
    var routelong = [];
    var cantidadrutas = 0;
    var routes = [];
    map.on('click', function(e) {
            // Obtener las coordenadas donde se hizo clic
            var latlng = e.latlng;

            var rlat=latlng.lat;
            var rlong=latlng.lng;
            cantidadrutas = cantidadrutas+1;

            routelat.push(rlat);
            routelong.push(rlong);

           var ruta = {
                lat: routelat,
                lng: routelong,
           }


            
            routes.push(latlng);
            /* var polyline = L.polyline(latlng, {
                color: 'black', 
                weight: 4,
                opacity: 1,
                smoothFactor: 1,
            }).addTo(map); */
            
            var polyline = L.polyline(routes, {color: 'black'}).addTo(map);
           
            console.log(cantidadrutas);
            console.log(routes);
            console.log(ruta);
            /* console.log(routelat);
            console.log(routelong);
            console.log(cantidadrutas); */

            document.getElementById("puntos").innerHTML= cantidadrutas;
        });

        function back() {
            if (routelat.length > 0 && routelong.length > 0) {
                routelat.pop();
                routelong.pop();
                cantidadrutas--;

                // Actualizar la polyline en el mapa
                routes.pop();
                map.eachLayer(function (layer) {
                    if (layer instanceof L.Polyline && layer.options.color ==="black") {
                        map.removeLayer(layer);
                    }
                });
                if (routes.length > 0) {
                    L.polyline(routes, {color: 'black'}).addTo(map);
                }

                // Actualizar el contador de puntos en la interfaz
                document.getElementById("puntos").innerHTML = cantidadrutas;

                console.log(routelat);
                console.log(routelong);
                console.log("Punto eliminado. Puntos restantes:", cantidadrutas);
            } else {
                console.log("No hay puntos para eliminar");
            }
        }

        function clearRoutes() {
   // Limpiar los arrays y resetear el contador
   routelat = [];
   routelong = [];
   routes = [];
   cantidadrutas = 0;

   // Eliminar todas las polylines del mapa
   map.eachLayer(function (layer) {
       if (layer instanceof L.Polyline && layer.options.color === "black") {
           map.removeLayer(layer);
       }
   });

   // Actualizar el contador de puntos en la interfaz
   document.getElementById("puntos").innerHTML = cantidadrutas;

   console.log("Todas las rutas han sido eliminadas");
}
        
        document.querySelector('form').addEventListener('submit', function(e) {
                e.preventDefault(); // Prevenir el envío por defecto del formulario
                
                var form = this;
                routelat.forEach(function(lat, index) {
                    var latInput = document.createElement('input');
                    latInput.type = 'hidden';
                    latInput.name = 'latitude[]';
                    latInput.value = lat;
                    form.appendChild(latInput);
                });
                
                routelong.forEach(function(long, index) {
                    var longInput = document.createElement('input');
                    longInput.type = 'hidden';
                    longInput.name = 'longitude[]';
                    longInput.value = long;
                    form.appendChild(longInput);
                });
                
                form.submit();
            });
        

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
        //var idRuta = 0;
        let color;
        rutas.forEach(ruta => {
            //console.log(ruta);

        //console.log(`Color para la ruta ${ruta.grupo}: ${color}`);
        //console.log(ruta.nombre);
    var polyline = L.polyline(ruta.coordenadas, {
    color: ruta.color_rutas,
    weight: 4,
    opacity: 1,
    smoothFactor: 1,
    })
    
    .bindPopup(`
    <div>
        <input type="hidden" name="id_ruta" id="id_ruta" value="${ruta.grupo}">
        <p>Esta es la ruta: ${ruta.nombre}</p>
        <a href="/bus-stops/admin/routes/eliminar/${ruta.grupo}" id=eliminar > Eliminar </a>
        <input type="button" name="relacionarR" id="relacionarR" onclick="relacionarLinea()">Relacionar</input>
    </div>`
    )
    .addTo(map);

    });

    function relacionarLinea(){
        var idRuta = document.getElementById('id_ruta').value;
        console.log('Ruta: ',idRuta);
        document.getElementById('busLine_id').value = idRuta;
    }

    var idsParadas = [];
    function relacionarParada(){
        var idParada = document.getElementById('id_parada').value;
        if (!idsParadas.includes(idParada)) {
            idsParadas.push(idParada);
        }
        
        document.getElementById('busStop_id').value = JSON.stringify(idsParadas);
        console.log('Parada: ',idsParadas);
    }
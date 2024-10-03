<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paradas de Colectivo</title>
    <link rel="stylesheet" href="{{ asset('css\menu.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" />
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> --}}
    <style>
        .leaflet-top.leaflet-left {
            left: 95vw; /* Ajusta este valor según el ancho de tu menú */
        }
        #eliminar {
        color: white;
        background-color: #ff0000;
        border-color: #ff0000;
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        }
        #editar{
        color: white;
        background-color: #007bff;
        border-color: #007bff;
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        text-align: right;
        }

        .leaflet-top.leaflet-left {
            left: 96.1vw; /* Ajusta este valor según el ancho de tu menú */
            top: 500px;
        }

        #map { height: 615px; }

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

        .form-container {
            display: inline-block;
            margin-right: 20px; /* Espaciado entre formularios */
        }

    </style>
</head>
<body>

    <div class="open-menu" onclick="openMenu()">&#9776;</div>
    <div id="overlay" class="overlay" onclick="closeMenu()"></div>

    <div id="searchContainer">
        <input type="text" id="searchInput" placeholder="Buscar parada...">
        <ul id="suggestions" class="suggestions-list"></ul>
    </div>
    
    <div id="menu" class="menu">
        <a href="javascript:void(0)" class="closebtn" onclick="closeMenu()">&times;</a>
        <a href="{{ route('bus-stops.index')}}">Inicio</a>
        <a href="{{ route('login') }}">Iniciar sesión</a>
        <a href="{{route('register')}}">Registrarse</a>
        <a>
            Mostrar Paradas de Colectivo
            <input type="checkbox" id="mostrarParadas" value="" name="Paradas" class="check" onchange="sm()" checked> 
        </a>
    </div>

    <input type="hidden" id="busStops" value="{{$busStops}}">

    <div id="map"></div>

    {{-- <form method="POST" action="{{route('bus-stops.store')}}">
        @csrf
        <label for="name">Nombre:</label>
        <input type="text" id="direction" name="direction" value = "direction" required>
        <label for="latitude">Latitud:</label>
        <input type="text" id="latitude" name="latitude" value = "laitude" required>
        <label for="longitude">Longitud:</label>
        <input type="text" id="longitude" name="longitude" value= "longitude" required>
        <button type="submit">Añadir Parada</button>
    </form> --}}
    <button onclick="back()">↩</button>
    <button onclick="clearRoutes()">CLEAR</button>
    <div class="form-container">
        <form method="POST" action="{{route('bus-stops.storeroutes')}}">
            @csrf
            <label for="road_group">Conjunto ruta:</label>
            <input type="number" min="1" max="11" id="road_group" name="road_group" required>

            <label for="latitude"></label>
            <input type="hidden" id="latitude" name="latitude[]" required>

            <label for="longitude"></label>
            <input type="hidden" id="longitude"  name="longitude[]" required>

            {{-- <label for="orden">orden:</label>
            <a type="text" id="order"  name="order" required> --}}

            <label for="puntos">Puntos seleccionados:</label>
            <a id="puntos"></a>
            <button type="submit">Añadir Ruta</button>
            
        </form>
    </div>
    <div class="form-container">
        <form method="POST" action="{{route('relacion')}}">
            @csrf
                <label for="busStop_id">Parada:</label>
                <input type="number" id="busStop_id" name="busStop_id" required>
                <label for="busLine_id">Ruta:</label>
                <input type="number" id="busLine_id" name="busLine_id" required>
                <button type="submit">Añadir Relacion</button>
        </form>    
    </div>

    <script src="{{ asset('js\menu.js') }}"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>
    <script src="{{ asset('js\jQuery.js') }}"></script>
    
    
    <script>
    const busStops = JSON.parse(document.getElementById('busStops').value);
    var rutas = <?php echo $rutas; ?>;
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
                        map.setView([busStop.latitude, busStop.longitude], 16);
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
            console.log(ruta);

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

        console.log(`Color para la ruta ${ruta.grupo}: ${color}`);

    var polyline = L.polyline(ruta.coordenadas, {
    color: color,
    weight: 4,
    opacity: 1,
    smoothFactor: 1,
    })
    
    .bindPopup(`
    <div>
        <input type="hidden" name="id_ruta" id="id_ruta" value="${ruta.grupo}">
        <p>Esta es la ruta: ${ruta.grupo}</p>
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

    function relacionarParada(){
        var idParada = document.getElementById('id_parada').value;
        console.log('Parada: ', idParada);
        document.getElementById('busStop_id').value = idParada;
    }

    </script>
</body>
</html>

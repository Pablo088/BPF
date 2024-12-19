//Este archivo se creo porque admin lte no te permite tener inputs del tipo checkbox en el panel lateral

function generarCheckbox(){
    let elementoActivo = document.querySelectorAll('a.nav-link.active');
    let barraLateral = '';
    
    elementoActivo.forEach(function(elemento){
        barraLateral = ((elemento.parentElement).parentElement).parentElement;
    });

    let checkParadas = document.createElement('input');
    checkParadas.type = 'checkbox';
    checkParadas.checked = true;
    checkParadas.id = 'mostrarParadas';
    checkParadas.className = 'check-show'
    
    let labelParadas = document.createElement('label');
    labelParadas.id = 'labelCheckParadas';
    labelParadas.className = 'label-check';
    labelParadas.innerHTML = 'Mostrar Paradas'
    labelParadas.appendChild(checkParadas)

    let checkRutas = document.createElement('input');
    checkRutas.type = 'checkbox';
    checkRutas.checked = true;
    checkRutas.id = 'mostrarRutas';
    checkRutas.className = 'check-show'

    let labelRutas = document.createElement('label');
    labelRutas.id = 'labelCheckRutas';
    labelRutas.className = 'label-check';
    labelRutas.innerHTML = 'Mostrar Rutas'
    labelRutas.appendChild(checkRutas)
    barraLateral.appendChild(labelParadas);
    barraLateral.appendChild(labelRutas);
}
export default generarCheckbox;
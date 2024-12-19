//Este archivo se creo porque admin lte no te permite tener inputs del tipo checkbox en el panel lateral

function generarCheckbox(){
    let elementoActivo = document.querySelectorAll('a.nav-link.active');
    let barraLateral = '';
    let checkParadas = document.createElement('input');
    let labelParadas = document.createElement('label');
    let checkRutas = document.createElement('input');
    let labelRutas = document.createElement('label');
    
    elementoActivo.forEach(function(elemento){
        barraLateral = ((elemento.parentElement).parentElement).parentElement;
    });

    checkParadas.type = 'checkbox';
    checkParadas.checked = true;
    checkParadas.id = 'mostrarParadas';
    checkParadas.className = 'check-show';
    
    labelParadas.id = 'labelCheckParadas';
    labelParadas.className = 'label-check';
    labelParadas.innerHTML = 'Mostrar Paradas';

    checkRutas.type = 'checkbox';
    checkRutas.checked = true;
    checkRutas.id = 'mostrarRutas';
    checkRutas.className = 'check-show';

    labelRutas.id = 'labelCheckRutas';
    labelRutas.className = 'label-check';
    labelRutas.innerHTML = 'Mostrar Rutas';
    
    labelParadas.appendChild(checkParadas)
    labelRutas.appendChild(checkRutas)
    barraLateral.appendChild(labelParadas);
    barraLateral.appendChild(labelRutas);
}
export default generarCheckbox;
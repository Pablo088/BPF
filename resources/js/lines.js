document.addEventListener('DOMContentLoaded', function() {
    const rows = document.querySelectorAll('.table-secondary');
    const modal = document.getElementById('infoModal');
    const closeModal = document.querySelector('.close');
    const modalInfo = document.getElementById('modalInfo');

    function loadAndShowLineData(lineId, clickedRow) {
        // Remover highlight de todas las filas
        document.querySelectorAll('.table tbody tr').forEach(row => {
            row.classList.remove('highlight');
        });
        
        // Agregar highlight a la fila seleccionada
        clickedRow.classList.add('highlight');

        fetch(`/Lines/buscar/${lineId}`)
            .then(response => response.json())
            .then(data => {
                let stopsInfo = '';
                if (data && data.bus_stops) {
                    data.bus_stops.forEach(stop => {
                        stopsInfo += `
                            <strong>Dirección de la parada:</strong> ${stop.direction} <br>
                            <strong>Latitud:</strong> ${stop.latitude} <br>
                            <strong>Longitud:</strong> ${stop.longitude} <br><br>
                        `;
                    });
                }

                modalInfo.innerHTML = `
                    <strong>Nombre de la línea:</strong> ${data.line_name} <br>
                    <strong>Horario Comienzo:</strong> ${data.horario_comienzo} <br>
                    <strong>Horario Finalización:</strong> ${data.horario_finalizacion} <br><br>
                    ${stopsInfo}
                `;
                modal.style.display = 'block';
            });
    }

    // Manejar el parámetro de la URL
    const urlParams = new URLSearchParams(window.location.search);
    const lineIdFromUrl = urlParams.get('line');
    console.log('ID recibido:', lineIdFromUrl);
    if (lineIdFromUrl) {
        const row = document.querySelector(`[data-line-id="${lineIdFromUrl}"]`);
        if (row) {
            loadAndShowLineData(lineIdFromUrl, row);
        }
    }

    rows.forEach(row => {
        row.addEventListener('click', function() {
            const id = this.querySelector('td:last-child').textContent;
            loadAndShowLineData(id, this);
        });
    });

    // Cerrar modal
    closeModal.addEventListener('click', () => modal.style.display = 'none');
    window.addEventListener('click', (event) => {
        if (event.target === modal) modal.style.display = 'none';
    });
});
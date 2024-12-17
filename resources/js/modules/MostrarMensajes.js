function mostrarMensaje(){
    let mensajeExito = document.getElementById('exito');
    let mensajeError = document.getElementById('error');
    if(mensajeExito !== null && mensajeError == null){
        Swal.fire({
            text: `${mensajeExito.value}`,
            icon: "success"
        });
    }else{
        console.log('Ocurrió un error');
    }
    if(mensajeError !== null){
        Swal.fire({
            text: `${mensajeError.value}`,
            icon: "error"
        });
    }else{
        console.log('Todo correcto');
    }
}

export default mostrarMensaje
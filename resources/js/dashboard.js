let paradaId = document.querySelectorAll(".paradaId");
let inputParada = document.getElementById("inputParada");
let form = document.getElementById("form");
//import { mostrarMensaje } from "./modules/MostrarMensajes";

paradaId.forEach(button => {
    button.addEventListener("click", (parada) => {
        inputParada.value = parada.currentTarget.value;
        form.submit();
    });
});

//mostrarMensaje();
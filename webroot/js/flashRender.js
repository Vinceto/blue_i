function mostrarMensajeFlash(mensaje, tipo) {
    var flashMessageContainer = document.getElementById('flash-message');
    flashMessageContainer.className = 'flash-messages flash-' + tipo; // Asigna la clase según el tipo
    flashMessageContainer.innerText = mensaje; // Establece el mensaje
    flashMessageContainer.style.display = 'block'; // Muestra el contenedor
    console.log(flashMessageContainer)
    flashMessageContainer.style.display = '';
    // Ocultar el mensaje después de 5 segundos
    setTimeout(function () {
        flashMessageContainer.style.display = 'none';
    }, 5000);
}
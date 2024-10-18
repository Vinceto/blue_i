/**
 * Función para validar un RUT chileno.
 * @param {string} rut - El RUT chileno que se desea validar.
 * @returns {boolean} - Retorna true si el RUT es válido, false en caso contrario.
 */
function validarRut(rut) {
    // Eliminar puntos, guiones y dejar solo números y 'K'
    rut = rut.replace(/[^0-9kK]/g, '');

    // Verificar longitud válida
    if (rut.length < 8 || rut.length > 9) {
        return false; // RUTs inválidos por longitud
    }

    var cuerpo = rut.slice(0, -1); // Números antes del dígito verificador
    var dv = rut.slice(-1).toUpperCase(); // Dígito verificador (último carácter)

    // Calcular el dígito verificador
    var suma = 0;
    var factor = 2;
    
    for (var i = cuerpo.length - 1; i >= 0; i--) {
        suma += parseInt(cuerpo[i]) * factor;
        factor = factor == 7 ? 2 : factor + 1;
    }

    var resto = 11 - (suma % 11);
    var dvEsperado = resto == 11 ? '0' : (resto == 10 ? 'K' : resto.toString());

    // Comparar con el dígito verificador proporcionado
    return dvEsperado == dv;
}

/**
 * Función para asociar la validación de RUT a un formulario.
 * @param {string} formId - El ID del formulario.
 * @param {string} rutFieldName - El atributo name del campo de RUT en el formulario.
 */
function validarRutEnFormulario(formId, rutFieldName) {
    var form = document.getElementById(formId);
    var rutField = document.querySelector("[name='" + rutFieldName + "']");
    var submitButton = form.querySelector('button[type="submit"]');

    // Deshabilitar el botón de envío al inicio
    submitButton.disabled = true;

    rutField.addEventListener('blur', function () {
        // Validar el RUT cuando el campo pierde el foco
        if (validarRut(rutField.value)) {
            // Si el RUT es válido, formatear y habilitar el botón de envío
            rutField.value = formatearRut(rutField.value);
            submitButton.disabled = false; // Habilitar el botón de envío
            console.log('RUT válido.')
            mostrarMensajeFlash('RUT válido.', 'success'); // Mostrar mensaje de éxito
        } else {
            // Si el RUT no es válido, mostrar un mensaje de error
            console.log('Por favor, ingrese un RUT chileno válido.')
            mostrarMensajeFlash('Por favor, ingrese un RUT chileno válido.', 'error'); // Mostrar mensaje de error
            rutField.value = ''; // Limpiar el campo si es inválido
            submitButton.disabled = true; // Asegurarse de que el botón permanezca deshabilitado
        }
    });
}


/**
 * Función para formatear un RUT chileno.
 * @param {string} rut - El RUT chileno que se desea formatear.
 * @returns {string} - El RUT formateado con puntos y guion.
 */
function formatearRut(rut) {
    // Eliminar cualquier formato previo
    rut = rut.replace(/[^0-9kK]/g, '');
    
    var cuerpo = rut.slice(0, -1); // Números antes del dígito verificador
    var dv = rut.slice(-1).toUpperCase(); // Dígito verificador (último carácter)

    // Añadir puntos como separador de miles
    cuerpo = cuerpo.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

    // Retornar el RUT formateado con puntos y guion
    return cuerpo + '-' + dv;
}
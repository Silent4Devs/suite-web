
// Obtener el elemento de input y la alerta
var miInput = document.getElementById('tema_reunion');
var alerta = document.getElementById('alertaTemaTratado');

var inputs = document.querySelectorAll('input[type="text"]');

miInput.addEventListener("input", updateValue);

// Añadir un evento de input al campo de entrada
function updateValue(e) {
    console.log(e);
    // Verificar si la longitud supera el límite (por ejemplo, 255 caracteres)
    if (miInput.value.length > 3) {
        alerta.style.display = 'block';
    } else {
        alerta.style.display = 'none';
    }
}

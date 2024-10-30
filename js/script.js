function evento() {
    alert('HOLA');
}

function mostrarFormulario() {
    let formulario = document.getElementById('formulario');
    formulario.style.display = formulario.style.display === 'none' ? 'block' : 'none';
    mostrarBoton()
}

function mostrarBoton() {
    let boton = document.getElementById('mostrar');
    boton.style.display = boton.style.display === 'none' ? 'block' : 'none';
}

function ocultarFormulario() {
    let formulario = document.getElementById('formulario');
    formulario.style.display = formulario.style.display === 'none' ? 'block' : 'none';
    ocultarBoton()
}
function ocultarBoton() {
    let boton = document.getElementById('enviar');
    boton.style.display = boton.style.display === 'none' ? 'block' : 'none';
}
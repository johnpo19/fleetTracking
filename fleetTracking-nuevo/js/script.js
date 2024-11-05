function redireccion() {
    
    location.href="php/fichaTec.php";
}



function volverInicio(){
    location.href="../inicio.php";
}

function toggleFormulario() {
    // Obtén el formulario
    const formulario = document.getElementById('formulario');
    // Alterna la clase 'active'
    formulario.classList.toggle('active');
}
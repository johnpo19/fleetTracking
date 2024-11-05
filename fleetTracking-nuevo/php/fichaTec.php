<?php
include_once 'bbdd.php';
session_start();
// Verificar si 'matricula' está establecida en la sesión antes de hacer la consulta
if (isset($_SESSION['matricula'])) {
    $matricula = $_SESSION['matricula'];

    // Hacer SELECT utilizando 'matricula' de la sesión
    $sql_leerUnico = 'SELECT * FROM vehiculo WHERE MATRICULA = ?';
    $gsent_unico = $pdo->prepare($sql_leerUnico);
    $gsent_unico->execute([$matricula]);
    $resultado_unico = $gsent_unico->fetchAll();
} else {
    // Mostrar mensaje de error si 'matricula' no está establecida
    echo "<p>Error: No se ha enviado ninguna matrícula. Vuelve al formulario y selecciona un vehículo.</p>";
    $resultado_unico = []; // Asignar un arreglo vacío para evitar errores en el foreach
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha Técnica</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>  

    <div class="ficha">
        <?php if (!empty($resultado_unico)): ?>
            <?php foreach ($resultado_unico as $dato): ?>
                <div class="listaFicha">
                    <?php echo 'Matrícula: ' . $dato['MATRICULA'] . '<br>' . 'Color: ' . ucfirst($dato['COLOR']) . '<br>' . 'Marca: ' . $dato['MARCA'] . '<br>' . 'Modelo: ' . $dato['MODELO']; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No se encontró ningún vehículo con esa matrícula.</p>
        <?php endif; ?>
    </div>

    <button onclick="volverInicio()">INICIO</button>

    <script src="../js/script.js"></script>
</body>
</html>

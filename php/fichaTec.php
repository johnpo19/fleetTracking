<?php
include_once 'bbdd.php';



$matricula = $_POST['matricula'];
$sql_leerUnico = 'SELECT * FROM vehiculo WHERE MATRICULA = ?'; // Leer la información de la base de datos de la tabla vehiculo
$gsent_unico = $pdo->prepare($sql_leerUnico);
$gsent_unico->execute(array($matricula));
$resultado_unico = $gsent_unico->fetchAll();
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
        <?php foreach ($resultado as $dato): ?>
            <div class="listaFicha">
                <?php echo 'Matrícula: ' . $dato['MATRICULA'] . '<br>' . 'Color: ' . ucfirst($dato['COLOR']) . '<BR>' . 'Marca: ' . $dato['MARCA'] . '<br>' . 'Modelo: ' . $dato['MODELO']; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <button onclick="volverInicio()">INICIO</button>


    <script src="../js/script.js"></script>
</body>

</html>
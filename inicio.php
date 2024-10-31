<?php
include_once 'php/bbdd.php';

$sql_leer = 'SELECT * FROM vehiculo'; // Leer la información de la base de datos de la tabla vehiculo
$gsent = $pdo->prepare($sql_leer);
$gsent->execute();
$resultado = $gsent->fetchAll();

if (isset($_POST['matricula']) && isset($_POST['color']) && isset($_POST['marca']) && isset($_POST['modelo'])) {
    $matricula = $_POST['matricula'];
    $color = $_POST['color'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];

    // Validar que los campos no estén vacíos
    if (!empty($matricula) && !empty($marca) && !empty($modelo) && !empty($color)) {
        $sql_agregar = 'INSERT INTO vehiculo (MATRICULA, MARCA, MODELO, COLOR) VALUES (?, ?, ?, ?)';
        $sentencia_agregar = $pdo->prepare($sql_agregar);
        
        // Ejecutar la inserción y manejar errores
        try {
            $sentencia_agregar->execute(array($matricula, $marca, $modelo, $color));
            echo '<script> alert("Coche agregado correctamente")</script>';

        } catch (PDOException $e) {
            echo "Error al agregar vehículo: " . $e->getMessage();
        }
    }else{
        echo '<script> alert("Rellena todo el formulario")</script>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Vehículos</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <section>
        <h4>Lista Vehículos</h4>
        <div class="cargar">
            <?php foreach ($resultado as $dato): ?>
                <div class="listaCargar" onclick="redireccion()">
                    <?php echo 'Matrícula: ' . $dato['MATRICULA'] . '<br>' . 'Color: ' . ucfirst($dato['COLOR']). '<BR>'.'Marca: ' . $dato['MARCA'] . '<br>' . 'Modelo: ' . $dato['MODELO']; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <h4>Agregar Vehículo</h4>
        <div class="insertar">
            <button id="mostrar" onclick="mostrarFormulario()" style="display: block;">Agregar</button>
            <form id="formulario" method="POST" style="display: none; ">
                <div>
                    <label for="matricula">Matricula:</label>
                    <input id="matricula" name="matricula" placeholder="Matricula" autofocus>
                </div>

                <div>
                    <label for="marca">Marca:</label>
                    <input id="marca" name="marca" placeholder="Marca">
                </div>

                <div>
                    <label for="modelo">Modelo:</label>
                    <input id="modelo" name="modelo" placeholder="Modelo">
                </div>

                <div>
                    <label for="color">Color:</label>
                    <input id="color" name="color" placeholder="Color">
                </div>

                <!-- <div>
                    <label for="carburante">Carburante:</label>
                    <select name="carburante" id="carburante">
                        <option value="gasolina">Gasolina</option>
                        <option value="diesel">Diésel</option>
                    </select>
                </div>

                <div>
                    <label for="cambio">Cambio:</label>
                    <select name="cambio" id="cambio">
                        <option value="automatico">Automático</option>
                        <option value="manual">Manual</option>
                    </select>

                </div>

                <div>
                    <label for="color">Color:</label>
                    <input id="color" name="color" placeholder="Color">
                </div>
                <div>
                    <label for="vin">Vin:</label>
                    <input id="vin" name="vin" placeholder="Vin">
                </div>
                <div>
                    <label for="numeroAsientos">Numero de Asiento:</label>
                    <input id="numeroAsientos" type="number" name="numeroAsientos" placeholder="Numero de Asientos">
                </div>
                <div>
                    <label for="numeroPuertas">Numero de puertas:</label>
                    <input id="numeroPuertas" type="number" name="numeroPuertas" placeholder="Numero de Puertas">
                </div>
                <div>
                    <label for="añoMatriculacion">Año de matriculación::</label>
                    <input id="añoMatriculacion" name="añoMatriuclacion" placeholder="Año de matriculació">
                </div>
                <div>
                    <label for="aseguradora">Aseguradora:</label>
                    <input id="aseguradora" name="aseguradora" placeholder="Aseguradora">
                </div>
                <div>
                    <label for="polizaSeguro">Poliza de seguro:</label>
                    <input id="polizaSeguro" name="polizaSeguro" placeholder="Poliza de seguro">
                </div>
                <div>
                    <label for="fechaProxItv">Fecha próxima ITV(yyyy-mm):</label>
                    <input id="fechaProxItv" type="month" name="fechaProxItv" placeholder="Fecha próxima ITV">
                </div>
                <div>
                    <label for="fechaUltimaRevision">Fecha última revisión:</label>
                    <input id="fechaUltimaRevision" type="date" name="fechaUltimaRevision" placeholder="Fecha última revisión">
                </div> -->

                <div>
                    <button type="submit" class="btinsertar" id="enviar" onclick="ocultarBoton()">Agregar</button>

                </div>
            </form>
        </div>

        <h4>Borrar Vehículo:</h4>
        <div class="editar">
            <p>Inserte la matrícula del coche que desea borrar</p>
            <form action="php/delete.php" method="post">
                <label for="matriculaEditar">Matricula:</label>
                <input id="matriculaEditar" name="matriculaEditar" placeholder="Matricula" required>

                <button type="submit" class="btborrar">Borrar</button>
            </form>
        </div>
    </section>

    <script src="js/script.js"></script>
</body>

</html>
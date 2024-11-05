<?php
session_start();
include_once 'php/bbdd.php';

// Consulta para obtener los vehículos existentes
$sql_leer = 'SELECT * FROM vehiculo'; 
$gsent = $pdo->prepare($sql_leer);
$gsent->execute();
$resultado = $gsent->fetchAll();

// Si el método de solicitud es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST['matricula'], $_POST['color'], $_POST['marca'], $_POST['modelo'], $_POST['vin'],
              $_POST['cambio'], $_POST['numeroAsientos'], $_POST['numeroPuertas'], 
              $_POST['añoMatriculacion'], $_POST['aseguradora'], $_POST['polizaSeguro'], 
              $_POST['fechaProxITV'], $_POST['fechaUltimaRevision'], $_POST['carburante'])
    ) {
        // Definir variables locales desde el formulario
        $matricula = $_POST['matricula'];
        $_SESSION['matricula'] = $matricula; // Guarda también en sesión si es necesario
        $modelo = $_POST['modelo'];
        $color = $_POST['color'];
        $marca = $_POST['marca'];
        $carburante = $_POST['carburante'];
        $cambio = $_POST['cambio'];
        $vin = $_POST['vin'];
        $numAsiento = $_POST['numeroAsientos']; 
        $numPuertas = $_POST['numeroPuertas']; 
        $añoMatriculacion = $_POST['añoMatriculacion'];
        $aseguradora = $_POST['aseguradora'];
        $poliza = $_POST['polizaSeguro']; 
        $fechaProxITV = $_POST['fechaProxITV'];
        $fechaUltRevision = $_POST['fechaUltimaRevision']; 

        // Validar que todas las variables están completas antes de proceder
        if (!empty($matricula) && !empty($marca) && !empty($modelo) && !empty($color) && 
            !empty($carburante) && !empty($cambio) && !empty($vin) && 
            !empty($numAsiento) && !empty($numPuertas) && 
            !empty($añoMatriculacion) && !empty($aseguradora) && 
            !empty($poliza) && !empty($fechaProxITV) && !empty($fechaUltRevision)) {
            
            // Preparar la consulta SQL para agregar el vehículo
            $sql_agregar = 'INSERT INTO vehiculo (MATRICULA, VIN, MARCA, MODELO, COLOR, CARBURANTE, CAMBIO, 
                           NUMERO_ASIENTOS, NUMERO_PUERTAS, AÑO_MATRICULACION, ASEGURADORA, POLIZA_SEGURO, 
                           FECHA_PROXIMA_ITV, FECHA_ULTIMA_REVISION) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
            $sentencia_agregar = $pdo->prepare($sql_agregar);
                header("Refresh:");
            try {
                // Ejecutar la consulta
                $sentencia_agregar->execute([
                    $matricula,
                    $vin,
                    $marca,
                    $modelo,
                    $color,
                    $carburante,
                    $cambio,
                    $numAsiento,
                    $numPuertas,
                    $añoMatriculacion,
                    $aseguradora,
                    $poliza,
                    $fechaProxITV,
                    $fechaUltRevision
                ]);
                echo '<script> alert("Coche agregado correctamente")</script>';
            } catch (PDOException $e) {
                // Manejo de errores
                error_log("Error al agregar vehículo: " . $e->getMessage());            }
        } else {
            echo '<script> alert("Rellena todo el formulario")</script>';
        }
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
                    <?php echo 'Matrícula: ' . $dato['MATRICULA'] . '<br>' . 'Color: ' . ucfirst($dato['COLOR']) . '<br>' . 'Marca: ' . $dato['MARCA'] . '<br>' . 'Modelo: ' . $dato['MODELO']; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <h4>Agregar Vehículo</h4>
        <div class="insertar">
            <button id="mostrar" onclick="toggleFormulario()">Agregar</button>
            <form id="formulario" method="POST">
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

                <div>
                    <label for="carburante">Carburante:</label>
                    <select name="carburante" id="carburante">
                        <option value="Gasolina">Gasolina</option>
                        <option value="Diesel">Diesel</option>
                        <option value="Electrico">Eléctrico</option>
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
                    <label for="vin">Vin:</label>
                    <input id="vin" name="vin" placeholder="Vin">
                </div>
                <div>
                    <label for="numeroAsientos">Número de asientos:</label>
                    <input id="numeroAsientos" type="number" name="numeroAsientos" placeholder="Número de asientos">
                </div>
                <div>
                    <label for="numeroPuertas">Número de puertas:</label>
                    <input id="numeroPuertas" type="number" name="numeroPuertas" placeholder="Número de puertas">
                </div>
                <div>
                    <label for="añoMatriculacion">Año de matriculación:</label>
                    <input id="añoMatriculacion" name="añoMatriculacion" placeholder="Año de matriculación">
                </div>
                <div>
                    <label for="aseguradora">Aseguradora:</label>
                    <input id="aseguradora" name="aseguradora" placeholder="Aseguradora">
                </div>
                <div>
                    <label for="polizaSeguro">Póliza de seguro:</label>
                    <input id="polizaSeguro" name="polizaSeguro" placeholder="Póliza de seguro">
                </div>
                <div>
                    <label for="fechaProxITV">Fecha próxima ITV (yyyy-mm):</label>
                    <input id="fechaProxITV" type="month" name="fechaProxITV" placeholder="Fecha próxima ITV">
                </div>
                <div>
                    <label for="fechaUltimaRevision">Fecha última revisión:</label>
                    <input id="fechaUltimaRevision" type="date" name="fechaUltimaRevision" placeholder="Fecha última revisión">
                </div>

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

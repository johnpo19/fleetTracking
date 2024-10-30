<?php
include_once 'php/bbdd.php';
// leer la información de la bbdd
$sql_leer = 'SELECT * FROM vehiculossimple';
$gsent = $pdo->prepare($sql_leer);
$gsent->execute();
$resultado = $gsent->fetchAll();

if ($_POST) {
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehículos</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <section>
        <h4>Lista Vehículos</h4>
        <div class="cargar">
            <?php foreach ($resultado as $dato): ?>
                <div class="listaCargar" onclick="evento()">
                    <?php echo 'Matrícula: ' . $dato['MATRICULA'] . '<br>' . 'Color: ' . ucfirst($dato['COLOR']); ?>
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

                <div>
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
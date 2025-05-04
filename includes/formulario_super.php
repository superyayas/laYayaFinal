<?php
include_once __DIR__ . '/../config.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrate</title>
    <link rel="stylesheet" href="styles.css">
    <?php
    include "cabecera.php";
    ?>
</head>
<body>
    
        <h2>Formulario de Supermercados</h2>
        <form action="<?= BASE_URL ?>../gestores/gestor_supermercado.php" method="post">
            <div>
            <label for="nombre">Nombre:</label><br>
            <input type="text" id="nombre" name="nombre" required>
            </div>

            <div>
            <label for="direccion_super">Dirección:</label><br>
            <input type="text" id="direccion_super" name="direccion" required>
            </div>

            <div>
            <label for="cuidad_super">Ciudad:</label><br>
            <input type="text" id="cuidad_super" name="cuidad" required>
            </div>

            <div>
            <label for="pais_producto">País:</label><br>
            <input type="text" id="pais_producto" name="pais" required>
            </div>

            <div>
                <button type="submit">Añadir supermercado</button>
            </div>
        </form>

</body>
</html>
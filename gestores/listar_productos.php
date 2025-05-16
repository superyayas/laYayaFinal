<?php
include_once __DIR__ . '/../config.php';
include_once __DIR__ . '/../modelo/bdd/mysql.php';

$sql = "SELECT p.ID_Producto, p.NombreProducto, p.Descripcion, p.Marca, pr.Precio
        FROM producto p
        INNER JOIN precioproducto pr ON p.ID_Producto = pr.ID_Producto
        ORDER BY p.ID_Categoria ASC";
$resultados = yayaBD::consultaLectura($sql);

yayaBD::cerrarConexion();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de productos</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>includes/styles.css">
</head>
<body>
<section class="completo">
        <article class="centrado">
            <h1>Productos disponibles</h1>

            <?php if ($resultados && count($resultados) > 0): ?>
                <table class="tabla">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resultados as $fila): ?>
                            <tr>
                                <td><?= htmlspecialchars($fila['ID_Producto']) ?></td>
                                <td><?= htmlspecialchars($fila['NombreProducto']) ?></td>
                                <td><?= htmlspecialchars(number_format($fila['Precio'], 2)) ?> €</td>
                                <td>
                                    <form action="cesta.php" method="post" style="display:inline;">
                                        <input type="hidden" name="ID_Producto" value="<?= htmlspecialchars($fila['ID_Producto']) ?>">
                                        <input type="submit" value="Añadir a la cesta">
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No hay productos disponibles.</p>
            <?php endif; ?>

            <p><a href="cesta.php">Ver mi cesta de la compra</a></p>
            <p><a href="<?= BASE_URL ?>/../sesiones/accesoUser.php">← Volver a mi perfil</a></p>
        </article>
    </section>

    <?php include_once __DIR__ . '/../includes/pie.html'; ?>
</body>
</html>
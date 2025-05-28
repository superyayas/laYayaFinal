<?php
include_once __DIR__ . '/../config.php';
include_once __DIR__ . '/../modelo/bdd/mysql.php';

session_start();

<<<<<<< HEAD
$cesta = $_SESSION['cesta'] ?? array();

$productosCesta = array();
if (!empty($cesta)) {
    $ids_productos = array_keys($cesta);
    $sql = "SELECT p.ID_Producto, p.NombreProducto, pr.Precio
            FROM producto p
            INNER JOIN precioproducto pr ON p.ID_Producto = pr.ID_Producto
            WHERE p.ID_Producto IN (" . implode(',', $ids_productos) . ")";
    $productosCesta = yayaBD::consultaLectura($sql);
=======
$cesta = $_SESSION['cesta'] ?? array(); // Obtener la cesta o un array vacío

$productos_en_cesta = array();
if (!empty($cesta)) {
    $ids_productos = array_keys($cesta);
    $sql = "SELECT p.ID_Producto, p.Nombre, pr.Precio
            FROM producto p
            INNER JOIN precio pr ON p.ID_Producto = pr.ID_Producto
            WHERE p.ID_Producto IN (" . implode(',', $ids_productos) . ")";
    $productos_en_cesta = yayaBD::consultaLectura($sql);
>>>>>>> d7787d635fd3c628907de18707ec61e884fc82cb
}

yayaBD::cerrarConexion();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cesta de la Compra</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>includes/styles.css">
</head>
<body>
    <?php include_once __DIR__ . '/../includes/cabecera.php'; ?>

    <section class="completo">
        <article class="centrado">
            <h1>Mi Cesta de la Compra</h1>

<<<<<<< HEAD
            <?php if (!empty($productosCesta)): ?>
=======
            <?php if (!empty($productos_en_cesta)): ?>
>>>>>>> d7787d635fd3c628907de18707ec61e884fc82cb
                <table class="tabla">
                    <thead>
                        <tr>
                            <th>Nombre</th>
<<<<<<< HEAD
                            <th>Precio Ud</th>
=======
                            <th>Precio Unitario</th>
>>>>>>> d7787d635fd3c628907de18707ec61e884fc82cb
                            <th>Cantidad</th>
                            <th>Precio Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total_cesta = 0; ?>
<<<<<<< HEAD
                        <?php foreach ($productosCesta as $producto): ?>
                            <?php $cantidad = $cesta[$producto['ID_Producto']]; ?>
                            <?php $precio_total_producto = $producto['Precio'] * $cantidad; ?>
                            <tr>
                                <td><?= htmlspecialchars($producto['NombreProducto']) ?></td>
=======
                        <?php foreach ($productos_en_cesta as $producto): ?>
                            <?php $cantidad = $cesta[$producto['ID_Producto']]; ?>
                            <?php $precio_total_producto = $producto['Precio'] * $cantidad; ?>
                            <tr>
                                <td><?= htmlspecialchars($producto['Nombre']) ?></td>
>>>>>>> d7787d635fd3c628907de18707ec61e884fc82cb
                                <td><?= htmlspecialchars(number_format($producto['Precio'], 2)) ?> €</td>
                                <td><?= htmlspecialchars($cantidad) ?></td>
                                <td><?= htmlspecialchars(number_format($precio_total_producto, 2)) ?> €</td>
                            </tr>
                            <?php $total_cesta += $precio_total_producto; ?>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" style="text-align:right;"><strong>Total:</strong></td>
                            <td><strong><?= htmlspecialchars(number_format($total_cesta, 2)) ?> €</strong></td>
                        </tr>
                    </tfoot>
                </table>
            <?php else: ?>
                <p>Tu cesta está vacía.</p>
            <?php endif; ?>

            <p><a href="listar_productos.php">Seguir comprando</a></p>
            <p><a href="<?= BASE_URL ?>/../sesiones/accesoUser.php">← Volver a mi perfil</a></p>
        </article>
    </section>

    <?php include_once __DIR__ . '/../includes/pie.html'; ?>
</body>
</html>
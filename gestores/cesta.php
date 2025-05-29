<?php
include_once __DIR__ . '/../config.php';
include_once __DIR__ . '/../modelo/bdd/mysql.php';

session_start();

$cesta1 = $_SESSION['cesta1'] ?? [];
$cesta2 = $_SESSION['cesta2'] ?? [];

function obtenerProductos($cesta) {
    if (empty($cesta)) return [];

    $ids = implode(",", array_map('intval', array_keys($cesta)));
    $sql = "SELECT p.ID_Producto, p.NombreProducto, pr.Precio
            FROM producto p
            INNER JOIN precioproducto pr ON p.ID_Producto = pr.ID_Producto
            WHERE p.ID_Producto IN ($ids)";
    return yayaBD::consultaLectura($sql);
}

$productos_cesta1 = obtenerProductos($cesta1);
$productos_cesta2 = obtenerProductos($cesta2);

yayaBD::cerrarConexion();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Comparar Cestas</title>
<link rel="stylesheet" href="<?= BASE_URL ?>includes/styles.css">
</head>
<body>
<?php include_once __DIR__ . '/../includes/cabecera.php'; ?>
<main style="flex: 1;">
<section class="completo">
<article class="centrado">
    <h1>Comparación de Cestas</h1>

    <form action="limpiar_Cesta.php" method="post" style="display:inline;">
        <input type="hidden" name="cesta" value="1">
        <input type="submit" value="🗑 Vaciar Cesta 1" class="boton boton-eliminar">
    </form>

    <form action="limpiar_Cesta.php" method="post" style="display:inline;">
        <input type="hidden" name="cesta" value="2">
        <input type="submit" value="🗑 Vaciar Cesta 2" class="boton boton-eliminar">
    </form>

    <form action="limpiar_Cesta.php" method="post" style="display:inline;">
        <input type="hidden" name="cesta" value="todas">
        <input type="submit" value="🗑 Vaciar Ambas Cestas" class="boton boton-eliminar">
    </form>

    <div class="cestas-comparadas">
    <!-- Cesta 1 -->
    <div class="seccion-contenedor">
        <h2>Cesta 1</h2>
        <?php if (!empty($productos_cesta1)): ?>
        <table class="tabla">
            <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            <?php $total1 = 0; ?>
            <?php foreach ($productos_cesta1 as $producto): ?>
                <?php
                $id = $producto['ID_Producto'];
                $cantidad = $cesta1[$id];
                $precio = $producto['Precio'];
                    $subtotal = $precio * $cantidad;
                $total1 += $subtotal;
                ?>
                <tr>
                <td><?= htmlspecialchars($producto['NombreProducto']) ?></td>
                <td><?= number_format($precio, 2) ?> €</td>
                <td><?= $cantidad ?></td>
                <td><?= number_format($subtotal, 2) ?> €</td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3" style="text-align:right;"><strong>Total:</strong></td>
                <td><strong><?= number_format($total1, 2) ?> €</strong></td>
            </tr>
            </tfoot>
        </table>
        <?php else: ?>
        <p>La cesta 1 está vacía.</p>
        <?php endif; ?>
    </div>

    <!-- Cesta 2 -->
    <div class="seccion-contenedor">
        <h2>Cesta 2</h2>
        <?php if (!empty($productos_cesta2)): ?>
        <table class="tabla">
            <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            <?php $total2 = 0; ?>
            <?php foreach ($productos_cesta2 as $producto): ?>
                <?php
                $id = $producto['ID_Producto'];
                $cantidad = $cesta2[$id];
                $precio = $producto['Precio'];
                  $subtotal = $precio * $cantidad;
                $total2 += $subtotal;
                ?>
                <tr>
                <td><?= htmlspecialchars($producto['NombreProducto']) ?></td>
                <td><?= number_format($precio, 2) ?> €</td>
                <td><?= $cantidad ?></td>
                <td><?= number_format($subtotal, 2) ?> €</td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3" style="text-align:right;"><strong>Total:</strong></td>
                <td><strong><?= number_format($total2, 2) ?> €</strong></td>
            </tr>
            </tfoot>
        </table>
        <?php else: ?>
        <p>La cesta 2 está vacía.</p>
        <?php endif; ?>
    </div>
    </div>

    <p><a href="listar_productos.php">← Volver a productos</a></p>
    <p><a href="<?= BASE_URL ?>/../sesiones/accesoUser.php">← Volver al perfil</a></p>
</article>
</section>
</main>
<?php include_once __DIR__ . '/../includes/pie.html'; ?>
</body>
</html>
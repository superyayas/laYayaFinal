<?php
include_once __DIR__ . '/../config.php';
include_once __DIR__ . '/../modelo/bdd/mysql.php';

// Obtenemos productos + precios + supermercados
$sql = "SELECT 
            p.ID_Producto, 
            p.NombreProducto, 
            p.Marca, 
            pr.Precio, 
            s.Nombre AS NombreSupermercado
        FROM producto p
        LEFT JOIN precioproducto pr ON p.ID_Producto = pr.ID_Producto
        LEFT JOIN supermercado s ON pr.ID_Supermercado = s.ID_Supermercado
        ORDER BY p.ID_Categoria ASC";


$resultados = yayaBD::consultaLectura($sql);
yayaBD::cerrarConexion();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de productos</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>includes/styles.css">
</head>
<body>
    <?php include_once __DIR__ . '/../includes/cabecera.php'; ?>
<section class="completo">
    <article class="centrado">
        <h1>Productos disponibles</h1>

        <?php if ($resultados && count($resultados) > 0): ?>
            <table class="tabla">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Marca</th>
                        <th>Precio</th>
                        <th>Supermercado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultados as $fila): ?>
                        <tr>
                            <td><?= htmlspecialchars($fila['ID_Producto']) ?></td>
                            <td><?= htmlspecialchars($fila['NombreProducto']) ?></td>
                            <td><?= htmlspecialchars($fila['Marca']) ?></td>
                            <td><?= htmlspecialchars(number_format($fila['Precio'], 2)) ?> €</td>
                            <td><?= htmlspecialchars($fila['NombreSupermercado']) ?></td>
                            <td class="acciones">
                                <form action="cesta.php" method="post" style="display:inline;">
                                    <input type="hidden" name="ID_Producto" value="<?= htmlspecialchars($fila['ID_Producto']) ?>">
                                    <input type="submit" class="boton boton-añadir" value="Añadir a la cesta">
                                </form>
                                <form action="modificar_producto.php" method="get" style="display:inline;">
                                    <input type="hidden" name="ID_Producto" value="<?= htmlspecialchars($fila['ID_Producto']) ?>">
                                    <input type="submit" class="boton boton-modificar" value="Modificar Producto">
                                </form>
                               <form action="eliminar_producto.php" method="post" class="form-eliminar">
                                    <input type="hidden" name="ID_Producto" value="<?= htmlspecialchars($fila['ID_Producto']) ?>">
                                    <input type="submit" class="boton boton-eliminar" value="Eliminar Producto">
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
<!-- Modal de confirmación -->
<div id="modalConfirmacion" class="modal" style="display:none;">
  <div class="modal-contenido">
    <p>¿Estás seguro/a de eliminar este producto?</p>
    <button id="confirmarEliminar">Sí, eliminar</button>
    <button onclick="cerrarModal()">Cancelar</button>
  </div>
</div>

<script>
  // Para que la URL base esté disponible globalmente (si lo usas con el buscador)
  window.BASE_URL = "<?= BASE_URL ?>";
</script>
<script src="<?= BASE_URL ?>includes/scripts.js"></script>


</body>
</html>


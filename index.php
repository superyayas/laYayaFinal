<?php
include_once __DIR__ . '/modelo/bdd/mysql.php';

$productos = yayaBD::consultaLectura(" SELECT p.*, pp.Precio AS PrecioMinimo, s.Nombre AS NombreSupermercado
    FROM Producto p
    LEFT JOIN PrecioProducto pp
        ON pp.ID_Precio = (
            SELECT pp2.ID_Precio
            FROM PrecioProducto pp2
            WHERE pp2.ID_Producto = p.ID_Producto
            ORDER BY pp2.Precio ASC
            LIMIT 1
        )
    LEFT JOIN Supermercado s ON pp.ID_Supermercado = s.ID_Supermercado
    ORDER BY p.NombreProducto ASC
");


?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaYaya</title>
    <link rel="stylesheet" href="includes/styles.css">

    
</head>
<body>
<h1>Productos disponibles</h1>

<?php
include 'includes/cabecera.php';
?>
 <div class="productos-container">
        <?php if ($productos): ?>
            <?php foreach ($productos as $producto): ?>
                 <a href="gestores/comparar.php?id=<?= $producto['ID_Producto'] ?>" class="producto-link">
                    <div class="producto">
                        <div class="contenedor-img">
                            <img src="includes/img/<?php echo htmlspecialchars($producto['Imagen']); ?>"
                            onerror="this.onerror=null; this.src='includes/img/default.png';"
                            alt="<?php echo htmlspecialchars($producto['NombreProducto']); ?>">
                        </div>
                            <h3><?php echo htmlspecialchars($producto['NombreProducto']); ?></h3>
                            <p><?php echo htmlspecialchars($producto['Descripcion']); ?></p>
                            <p><strong>Marca:</strong> <?php echo htmlspecialchars($producto['Marca']); ?></p>
                                <p><strong>Precio desde:</strong>
                            <?php echo $producto['PrecioMinimo'] !== null
                                ? number_format($producto['PrecioMinimo'], 2) . ' €'
                                : 'No disponible'; ?> </p>
                                <?php if ($producto['NombreSupermercado']): ?>
                                <p><strong>Supermercado:</strong> <?php echo htmlspecialchars($producto['NombreSupermercado']); ?></p>
                                <?php endif; ?>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay productos disponibles.</p>
        <?php endif; ?>
    </div>
			
<?php
include "includes/pie.html";
?>
</body>
</html>
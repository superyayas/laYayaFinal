<?php
include_once '../config.php';
include_once '../includes/funciones.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<h2>Producto no válido</h2>";
    exit;
}

$idProducto = intval($_GET['id']);
$conexion = conectarBD();

// Obtener información básica del producto
$sqlProducto = "
    SELECT p.NombreProducto, p.Descripcion, p.Marca, p.Imagen, c.Nombre AS Categoria
    FROM producto p
    JOIN categoria c ON p.ID_Categoria = c.ID_Categoria
    WHERE p.ID_Producto = ?
";
$stmt = $conexion->prepare($sqlProducto);
$stmt->bind_param("i", $idProducto);
$stmt->execute();
$resultado = $stmt->get_result();
$producto = $resultado->fetch_assoc();

if (!$producto) {
    echo "<h2>Producto no encontrado</h2>";
    exit;
}

// Obtener los precios del producto en los supermercados
$sqlPrecios = "
    SELECT s.Nombre AS Supermercado, pp.Precio, pp.FechaRegistro
    FROM precioproducto pp
    JOIN supermercado s ON pp.ID_Supermercado = s.ID_Supermercado
    WHERE pp.ID_Producto = ?
    ORDER BY pp.Precio ASC
";
$stmt = $conexion->prepare($sqlPrecios);
$stmt->bind_param("i", $idProducto);
$stmt->execute();
$precios = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comparador de Precios</title>
   <link rel="stylesheet" href="<?php echo BASE_URL; ?>includes/styles.css">
    <?php include_once __DIR__ . '/../includes/cabecera.php'; ?>
</head>
<body>
    <div class="comparador-container">
        <div class="producto-info">
            <img src="../includes/img/<?php echo htmlspecialchars($producto['Imagen']); ?>"
                 alt="<?php echo htmlspecialchars($producto['NombreProducto']); ?>"
                 onerror="this.onerror=null; this.src='../includes/img/default.png';">
            <h1><?php echo htmlspecialchars($producto['NombreProducto']); ?></h1>
            <p><strong>Descripción:</strong> <?php echo htmlspecialchars($producto['Descripcion']); ?></p>
            <p><strong>Marca:</strong> <?php echo htmlspecialchars($producto['Marca']); ?></p>
            <p><strong>Categoría:</strong> <?php echo htmlspecialchars($producto['Categoria']); ?></p>
        </div>

        <div class="precio-lista">
            <h2>Precios en supermercados</h2>
            <?php if ($precios): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Supermercado</th>
                            <th>Precio</th>
                            <th>Fecha de registro</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($precios as $p): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($p['Supermercado']); ?></td>
                                <td><?php echo number_format($p['Precio'], 2); ?> €</td>
                                <td><?php echo date("d/m/Y", strtotime($p['FechaRegistro'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No hay precios registrados para este producto aún.</p>
            <?php endif; ?>
        </div>
            <div class="volver-container">
                <p><a href="../index.php" class="boton boton-volver">← Volver al inicio</a></p>
            </div>
    </div>
</body>
</html>

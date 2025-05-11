<?php
include_once __DIR__ . '/../config.php';
include_once __DIR__ . '/../modelo/bdd/mysql.php';

$nombre = $_GET['nombre'] ?? '';
$nombre = trim($nombre);

if ($nombre === '') {
    echo "<p>Texto de búsqueda vacío.</p>";
    exit;
}

$sql = "SELECT ID_Producto, Nombre, Precio FROM producto WHERE Nombre LIKE ?";
$param = '%' . $nombre . '%';
$resultados = yayaBD::consultaLectura($sql, $param);
yayaBD::cerrarConexion();

if ($resultados) {
    echo "<ul>";
    foreach ($resultados as $producto) {
        echo "<li><strong>" . htmlspecialchars($producto['Nombre']) . "</strong> - " . htmlspecialchars($producto['Precio']) . " €</li>";
    }
    echo "</ul>";
} else {
    echo "<p>No se encontraron productos.</p>";
}
?>

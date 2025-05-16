<?php
include_once __DIR__ . '/../config.php';
include_once __DIR__ . '/../modelo/bdd/mysql.php';

$nombre = $_GET['nombre'] ?? '';
$nombre = trim($nombre);

if ($nombre === '') {
    echo "<p>Texto de búsqueda vacío.</p>";
    exit;
}

$sql = "SELECT ID_Producto, NombreProducto, Descripcion, Marca FROM producto WHERE NombreProducto LIKE ?";
$param = '%' . $nombre . '%';
$resultados = yayaBD::consultaLectura($sql, $param);
yayaBD::cerrarConexion();

if ($resultados) {
    echo "<ul>";
    foreach ($resultados as $producto) {
        // uso NombreProducto, Descripcion y Marca
        $nombre     = htmlspecialchars($producto['NombreProducto']);
        $descripcion= htmlspecialchars($producto['Descripcion']);
        $marca      = htmlspecialchars($producto['Marca']);
        echo "<li>
                <strong>{$nombre}</strong><br>
                {$descripcion}<br>
                <em>Marca: {$marca}</em>
              </li>";
    }
    echo "</ul>";
} else {
    echo "<p>No se encontraron productos.</p>";
}
?>

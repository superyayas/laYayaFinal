<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: accesoUser.php"); // Redirige si no hay sesión iniciada
    exit();
}
require_once "../modelo/bdd/mysql.php"; // Asegúrate de que la ruta sea correcta

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $conexion = yayaBD::obtenerConexion();
        $nombre = htmlspecialchars($_POST['nombre_producto']);
        $descripcion = htmlspecialchars($_POST['descripcion_producto']);
        $precio = floatval($_POST['precio_producto']);

        $consulta = $conexion->prepare("INSERT INTO productos (nombre, descripcion, precio) VALUES (?, ?, ?)");
        $consulta->execute([$nombre, $descripcion, $precio]);

        echo "<p>Producto insertado correctamente.</p>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        if ($conexion) {
            yayaBD::cerrarConexion();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Productos</title>
    <link rel="stylesheet" href="../styles.css">
    <style>
        .logout {
        text-align: right;
        margin-top: 20px;
        }
        .logout a {
        color: red;
        text-decoration: none;
        }
</style>
</head>
<body>
    <h1>Añadir Nuevo Producto</h1>
    <form method="post" action="gestion_productos.php">
        <label for="nombre_producto">Nombre:</label><br>
        <input type="text" name="nombre_producto" required><br><br>

        <label for="descripcion_producto">Descripción:</label><br>
        <textarea name="descripcion_producto" required></textarea><br><br>

        <label for="precio_producto">Precio:</label><br>
        <input type="number" name="precio_producto" step="0.01" required><br><br>

        <input type="submit" value="Añadir Producto">
    </form>

    <div class="logout">
        <a href="../index.php">Cerrar sesión</a>
    </div>
</div>

</body>
</html>
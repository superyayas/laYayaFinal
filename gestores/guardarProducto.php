<?php
include_once '../config.php';
include_once '../includes/funciones.php';
include_once '../utils.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conexion = conectarBD();

$datos = productos();

if ($datos && count($datos) === 5) {
    list($nombre, $descripcion, $id_categoria, $marca, $precio) = $datos;
    $id_supermercado = intval($_POST['id_supermercado']);

    //  Usa un valor temporal si no hay sesión (por pruebas locales sin login)
    $id_usuario = $_SESSION['id_usuario'] ?? 1; // ← O usa null si no necesitas ID

    // Insertar producto

    //Añadir una imagen al producto
    $imagen = imagenPorNombre($nombre);

    $sql = "INSERT INTO producto (NombreProducto, Descripcion, ID_Categoria, Marca, Imagen)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssiss", $nombre, $descripcion, $id_categoria, $marca, $imagen);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $id_producto = $stmt->insert_id;

        // Insertar precio
        $sql_precio = "INSERT INTO precioproducto (ID_Producto, Precio, ID_Supermercado, ID_Usuario)
                       VALUES (?, ?, ?, ?)";
        $stmt_precio = $conexion->prepare($sql_precio);
        $stmt_precio->bind_param("idii", $id_producto, $precio, $id_supermercado, $id_usuario);
        $stmt_precio->execute();

        echo "<h2> Producto añadido correctamente</h2>";
        $stmt_precio->close();
    } else {
        echo "<h2> Error al añadir el producto</h2>";
    }

    $stmt->close();
} else {
    echo "<h2> Faltan campos del formulario</h2>";
}

$conexion->close();
?>

<br>
<a href="../gestores/add_producto.php"> Añadir otro producto</a><br>
<a href="../gestores/listar_productos.php"> Ver lista de productos</a>


<?php
include_once '../config.php';
include_once '../includes/funciones.php';
session_start();

$conexion = conectarBD();  

$datos = productos();

if ($datos && $datos[5]) {
    list($nombre, $descripcion, $id_categoria, $marca, $precio) = $datos;

    $sql = "INSERT INTO producto (NombreProducto, Descripcion, ID_Categoria, Marca)
            VALUES (?, ?, ?, ?)";

$stmt = $conexion->prepare($sql);

    $stmt->bind_param("ssis", $nombre, $descripcion, $id_categoria, $marca);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<h2> Producto añadido correctamente</h2>";
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
<a href="../gestores/ver_productos.php"> Ver lista de productos</a>




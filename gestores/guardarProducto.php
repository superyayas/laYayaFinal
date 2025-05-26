<?php
include_once '../config.php';
include_once '../includes/funciones.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conexion = conectarBD();

$datos = productos();

if ($datos && count($datos) === 5) {
    list($nombre, $descripcion, $id_categoria, $marca, $precio) = $datos;
    $id_supermercado = intval($_POST['id_supermercado']);
    $id_usuario = $_SESSION['id_usuario'] ?? 1; // Temporal o desde sesión

    // Obtener nombre de la categoría para elegir imagen
    $stmt_categoria = $conexion->prepare("SELECT Nombre FROM Categoria WHERE ID_Categoria = ?");
    $stmt_categoria->bind_param("i", $id_categoria);
    $stmt_categoria->execute();
    $resultado = $stmt_categoria->get_result();

    if ($resultado && $fila = $resultado->fetch_assoc()) {
        $nombre_categoria = $fila['Nombre'];
        $imagen = imagenPorNombreCategoria($nombre_categoria);
    } else {
        $imagen = 'default.png';
    }
    $stmt_categoria->close();

    // Buscar si el producto ya existe
    $sql_busqueda = "SELECT ID_Producto FROM producto WHERE NombreProducto = ? AND Marca = ? AND ID_Categoria = ?";
    $stmt_busqueda = $conexion->prepare($sql_busqueda);
    $stmt_busqueda->bind_param("ssi", $nombre, $marca, $id_categoria);
    $stmt_busqueda->execute();
    $resultado_busqueda = $stmt_busqueda->get_result();

    if ($fila = $resultado_busqueda->fetch_assoc()) {
        // Producto ya existe
        $id_producto = $fila['ID_Producto'];
    } else {
        // Insertar nuevo producto
        $sql_insert = "INSERT INTO producto (NombreProducto, Descripcion, ID_Categoria, Marca, Imagen)
                       VALUES (?, ?, ?, ?, ?)";
        $stmt_insert = $conexion->prepare($sql_insert);
        $stmt_insert->bind_param("ssiss", $nombre, $descripcion, $id_categoria, $marca, $imagen);
        $stmt_insert->execute();
        $id_producto = $stmt_insert->insert_id;
        $stmt_insert->close();
    }
    $stmt_busqueda->close();

    // Verificar si ya existe este precio para este producto y supermercado por este usuario
    $sql_check_precio = "SELECT 1 FROM precioproducto 
                         WHERE ID_Producto = ? AND Precio = ? AND ID_Supermercado = ? AND ID_Usuario = ?";
    $stmt_check = $conexion->prepare($sql_check_precio);
    $stmt_check->bind_param("idii", $id_producto, $precio, $id_supermercado, $id_usuario);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows === 0) {
        // Insertar nuevo precio
        $sql_precio = "INSERT INTO precioproducto (ID_Producto, Precio, ID_Supermercado, ID_Usuario)
                       VALUES (?, ?, ?, ?)";
        $stmt_precio = $conexion->prepare($sql_precio);
        $stmt_precio->bind_param("idii", $id_producto, $precio, $id_supermercado, $id_usuario);
        $stmt_precio->execute();
        echo "<h2>✅ Producto y precio añadidos correctamente</h2>";
        $stmt_precio->close();
    } else {
        echo "<h2>⚠️ Ya has registrado este precio para este producto y supermercado</h2>";
    }
    $stmt_check->close();

    //Aplicar CSS
} else {
    echo "<h2>❌ Faltan campos del formulario</h2>";
}

$conexion->close();
?>

<br>
<a href="../gestores/add_producto.php">➕ Añadir otro producto</a><br>
<a href="../gestores/listar_productos.php">📄 Ver lista de productos</a>


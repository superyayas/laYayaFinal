<?php
include_once __DIR__ . '/../config.php';
include_once __DIR__ . '/../modelo/bdd/mysql.php';

$id = $_GET['ID_Producto'] ?? null;
if (!$id) {
    header('Location: listar_productos.php');
    exit;
}

// Procesar actualización
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre       = trim($_POST['nombre_producto']);
    $descripcion  = trim($_POST['descripcion']);
    $marca        = trim($_POST['marca']);
    $precio       = floatval($_POST['precio']);
    $id_categoria = intval($_POST['id_categoria']);

    // Actualizar producto
    $sql1 = "UPDATE producto SET NombreProducto = ?, Descripcion = ?, Marca = ?, ID_Categoria = ? WHERE ID_Producto = ?";
    yayaBD::consultaInsercionBD($sql1, $nombre, $descripcion, $marca, $id_categoria, $id);

    // Actualizar precio
    // Verificamos si ya hay precio
$existePrecio = yayaBD::consultaLectura("SELECT COUNT(*) AS total FROM precioproducto WHERE ID_Producto = ?", $id)[0]['total'];

if ($existePrecio > 0) {
    // Actualizar si ya existe
    $sql2 = "UPDATE precioproducto SET Precio = ? WHERE ID_Producto = ?";
    yayaBD::consultaInsercionBD($sql2, $precio, $id);
} else {
    // Insertar si no existe
    $id_supermercado = 1; // O usa una forma de obtenerlo dinámicamente
    $id_usuario = $_SESSION['id_usuario'] ?? 1; // Valor temporal o real según login
    $sql2 = "INSERT INTO precioproducto (ID_Producto, Precio, ID_Supermercado, ID_Usuario)
             VALUES (?, ?, ?, ?)";
    yayaBD::consultaInsercionBD($sql2, $id, $precio, $id_supermercado, $id_usuario);
}


    yayaBD::cerrarConexion();
    header('Location: listar_productos.php');
    exit;
}

// Obtener datos actuales del producto
$sql = "SELECT p.NombreProducto, p.Descripcion, p.Marca, p.ID_Categoria, pr.Precio
        FROM producto p
        LEFT JOIN precioproducto pr ON p.ID_Producto = pr.ID_Producto
        WHERE p.ID_Producto = ?";
;
$producto = yayaBD::consultaLectura($sql, $id)[0] ?? null;

if (!$producto) {
    header('Location: listar_productos.php');
    exit;
}

// Cargar categorías
$sqlCat = "SELECT ID_Categoria, Nombre FROM categoria";
$categorias = yayaBD::consultaLectura($sqlCat);

yayaBD::cerrarConexion();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Modificar Producto</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>includes/styles.css">
</head>
<body>

<?php include_once __DIR__ . '/../includes/cabecera.php'; ?>
<main style="flex: 1;">
<section class="formulario-producto">
  <h2>Modificar Producto</h2>
  <h3><strong>ID:</strong> <?= htmlspecialchars($id) ?></h3><br>

    <form method="post" class="form-add-producto" action="">

      <label>Nombre del producto:</label>
      <input type="text" name="nombre_producto" value="<?= htmlspecialchars($producto['NombreProducto']) ?>" required>

      <label>Descripción:</label>
      <textarea name="descripcion" required><?= htmlspecialchars($producto['Descripcion']) ?></textarea>

      <label>Marca:</label>
      <input type="text" name="marca" value="<?= htmlspecialchars($producto['Marca']) ?>">

      <label>Precio:</label>
      <input type="number" step="0.01" name="precio" value="<?= htmlspecialchars($producto['Precio']) ?>" required>

      <label>Categoría:</label>
      <select name="id_categoria" required>
        <?php foreach ($categorias as $cat): ?>
          <option value="<?= $cat['ID_Categoria'] ?>" <?= $cat['ID_Categoria'] == $producto['ID_Categoria'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($cat['Nombre']) ?>
          </option>
        <?php endforeach; ?>
      </select>

      <div class="botones-crud">
        <input type="submit" class="boton" value="Guardar cambios">
        <a class="boton boton-salir" href="listar_productos.php">Cancelar</a>
      </div>
    </form>
    <p><a href="<?= BASE_URL ?>/../sesiones/accesoUser.php">← Volver a mi perfil</a></p>
 </section>
</main>

<?php include_once __DIR__ . '/../includes/pie.html'; ?>
</body>
</html>


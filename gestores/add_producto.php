<?php
include_once '../config.php';
include_once '../includes/funciones.php';



$conexion = conectarBD();

$categorias = $conexion->query("SELECT ID_Categoria, Nombre FROM categoria");
$supermercados = $conexion->query("SELECT ID_Supermercado, Nombre FROM supermercado");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Añadir producto</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>includes/styles.css">
</head>
<body>

<?php include_once '../includes/cabecera.php'; ?>

<h2>Añadir Nuevo Producto</h2>

<form action="../gestores/guardarProducto.php" method="post">
  <label>Nombre del producto:</label><br>
  <input type="text" name="nombre_producto" required><br><br>

  <label>Descripción:</label><br>
  <textarea name="descripcion" required></textarea><br><br>

  <label>Marca:</label><br>
  <input type="text" name="marca"><br><br>

  <label>Supermercado:</label><br>
  <select name="id_supermercado" required>
    <?php while ($fila = $supermercados->fetch_assoc()): ?>
      <option value="<?= $fila['ID_Supermercado'] ?>"><?= htmlspecialchars($fila['Nombre']) ?></option>
    <?php endwhile; ?>
  </select><br><br>

  <label>Precio:</label><br>
  <input type="number" step="0.01" name="precio" required><br><br>

  <label>Categoría:</label><br>
  <select name="id_categoria" required>
    <?php while ($fila = $categorias->fetch_assoc()): ?>
      <option value="<?= $fila['ID_Categoria'] ?>"><?= htmlspecialchars($fila['Nombre']) ?></option>
    <?php endwhile; ?>
  </select><br><br>

  <div class="botones-crud">
    <input type="submit" class="boton" value="Añadir Producto">
  </div>
</form>

<p><a href="<?= BASE_URL ?>/../sesiones/accesoUser.php">← Volver a mi perfil</a></p>

<?php include_once '../includes/pie.html'; ?>

</body>
</html>




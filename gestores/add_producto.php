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

<section class="formulario-producto">
  <h2>Añadir Nuevo Producto</h2>

  <form action="../gestores/guardarProducto.php" method="post" class="form-add-producto">
    <input type="text" name="nombre_producto" placeholder="Nombre del producto" required>
    
    <textarea name="descripcion" placeholder="Descripción" required></textarea>

    <input type="text" name="marca" placeholder="Marca">

    <select name="id_supermercado" required>
      <?php while ($fila = $supermercados->fetch_assoc()): ?>
        <option value="<?= $fila['ID_Supermercado'] ?>"><?= htmlspecialchars($fila['Nombre']) ?></option>
      <?php endwhile; ?>
    </select>

    <input type="number" step="0.01" name="precio" placeholder="Precio (€)" required>

    <select name="id_categoria" required>
      <?php while ($fila = $categorias->fetch_assoc()): ?>
        <option value="<?= $fila['ID_Categoria'] ?>"><?= htmlspecialchars($fila['Nombre']) ?></option>
      <?php endwhile; ?>
    </select>

    <input type="submit" value="Añadir Producto" >

  </form>

  <div class="boton-salir-container">
    <button onclick="location.href='<?= BASE_URL ?>/../sesiones/accesoUser.php'" class="boton-salir">← Volver a mi perfil</button>
  </div>
</section>

</body>
</html>




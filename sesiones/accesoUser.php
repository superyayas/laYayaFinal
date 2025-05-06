<?php
include_once __DIR__ . '/../config.php';

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Área de Usuario</title>
  <link rel="stylesheet" href="../includes/styles.css">
</head>
<body>
  <?php
  include "../includes/cabecera.php";
  ?>
  <h1>Bienvenido, <?= htmlspecialchars($_SESSION['usuario']) ?></h1>
  <nav>
    <ul>
      <li><a href="gestion_productos.php">Gestionar productos</a></li>

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
  </nav>
  <h1>Añadir un nuevo supermercado</h1>
    <a href="<?= BASE_URL ?>gestores/add_supermercado.php" class="btn">Añadir un nuevo supermercado</a>
    <a href="<?= BASE_URL ?>gestores/listar_supermercado.php" class="btn">Comprobar los supermercados</a>
  <?php
  include "../includes/pie.html";
  ?>

</body>
</html>

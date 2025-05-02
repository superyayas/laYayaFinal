<?php
session_start();
if (empty($_SESSION['usuario'])) {
    header("Location: sesiones/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Área de Usuario</title>
  <!--<link rel="stylesheet" href="../includes/styles.css">-->
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

    <h1>Añadir un nuevo supermercado</h1>

    <form action="../gestores/gestor_supermercado.php" method="post" >
        <label for="nombre">Nombre:</label><br>
        <input type="text" name="Nombre" required><br><br>

        <label for="direccion_super">Dirección:</label><br>
        <input type="name" name="Direccion" required><br><br>

        <label for="cuidad_super">Cuidad:</label><br>
        <input type="name" name="Cuidad" required><br><br>

        <label for="pais_producto">País:</label><br>
        <input type="name" name="Pais"required><br><br>

        <input type="submit" value="Añadir super">
    </form>

      <li><a href="logout.php">Cerrar sesión</a></li>
    </ul>
  </nav>
  <?php
  include "../includes/pie.html";
  ?>

</body>
</html>

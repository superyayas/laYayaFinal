<?php
include_once __DIR__ . '/../config.php';

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Área de Usuario</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>includes/styles.css">

</head>
<body>
  <?php
  include "../includes/cabecera.php";
  ?>
  <main style="flex: 1;">
  <h1>Bienvenido, <?= htmlspecialchars($_SESSION['usuario']) ?></h1>


<div class="seccion-contenedor">
    <h2 class="seccion-centrada">Gestión de Mis Productos</h2>
      <div class="botones-crud">
          <a href="<?= BASE_URL ?>gestores/listar_productos.php" class="boton"> Ver Mis Productos </a>
          <a href="<?= BASE_URL ?>gestores/add_producto.php" class="boton"> Añadir Producto </a>
      </div>

  <h2 class="seccion-centrada">Gestión de supermercado</h2>
   <div class="botones-crud">
      <a href="<?= BASE_URL ?>gestores/add_supermercado.php" class="boton">Añadir un nuevo supermercado</a>
      <a href="<?= BASE_URL ?>gestores/listar_supermercado.php" class="boton">Comprobar los supermercados</a>
  </div>
  </div>
  </main>
 <?php include "../includes/pie.html"; ?>

</body>
</html>

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
  <h1>Bienvenido, <?= htmlspecialchars($_SESSION['usuario']) ?></h1>

<!-- Aquí resultado del buscador -->
 
<div id="resultados"></div>

    <h2>Gestión de Mis Productos</h2>
      <div class="botones-crud">
          <a href="<?= BASE_URL ?>gestores/listar_productos.php" class="boton"> Ver Mis Productos </a>
          <a href="<?= BASE_URL ?>gestores/add_producto.php" class="boton"> Añadir Producto </a>
      </div>

  <h2>Añadir un nuevo supermercado</h2>
   <div class="botones-crud">
      <a href="<?= BASE_URL ?>gestores/add_supermercado.php" class="boton">Añadir un nuevo supermercado</a>
      <a href="<?= BASE_URL ?>gestores/listar_supermercado.php" class="boton">Comprobar los supermercados</a>
  </div>
  <?php
  include "../includes/pie.html";
  ?>

</body>
</html>

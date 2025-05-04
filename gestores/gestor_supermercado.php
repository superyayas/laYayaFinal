<?php
include_once __DIR__ . '/../includes/funciones.php';
include_once __DIR__ . '/../modelo/bdd/mysql.php';
include_once __DIR__ . '/../config.php';

$datos = parametros();
if (!$datos || count($datos) < 4) {
    exit();
}
list($nombre, $direccion, $ciudad, $pais) = $datos;

$sql = "INSERT INTO supermercado
        (Nombre, Direccion, Ciudad, Pais)
        VALUES (?, ?, ?, ?)";

try {
  $insert = yayaBD::consultaInsercionBD($sql, $nombre, $direccion, $ciudad, $pais);
} catch (mysqli_sql_exception $e) {
  if ($e->getCode() === 1062) {
      $insert = false;
      $errorMsg = "El supermercado ya está añadido.";
  } else {
      throw $e;
  }
}
yayaBD::cerrarConexion();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Alta supermercado</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>includes/styles.css">
</head>
<body>
  <?php include_once __DIR__ . '/../includes/cabecera.php'; ?>

  <?php if ($insert): ?>
    <section class="completo">
      <article class="centrado">
        <h1>Supermercado añadido correctamente</h1>
        <p>El supermercado <strong><?= htmlspecialchars($nombre) ?></strong> ha sido registrado.</p>
        <a href="<?= BASE_URL ?>index.php">Volver al inicio</a>
      </article>
    </section>
  <?php else: ?>
    <section class="completo">
      <article class="centrado">
        <h1><?= isset($errorMsg) ? htmlspecialchars($errorMsg) : 'Error al crear el supermercado' ?></h1>
        <p><a href="<?= BASE_URL ?>includes/formulario.php">Volver al formulario</a></p>
      </article>
    </section>
  <?php endif; ?>

  <?php include_once __DIR__ . '/../includes/pie.html'; ?>
</body>
</html>

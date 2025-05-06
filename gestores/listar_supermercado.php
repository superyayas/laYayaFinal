<?php
include_once __DIR__ . '/../config.php';
include_once __DIR__ . '/../modelo/bdd/mysql.php';

$sql = "SELECT ID_Supermercado, Nombre, Direccion, Ciudad, Pais
        FROM supermercado
        ORDER BY ID_Supermercado ASC";
$resultados = yayaBD::consultaLectura($sql);

yayaBD::cerrarConexion();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Supermercados</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>includes/styles.css">
</head>
<body>
  <?php include_once __DIR__ . '/../includes/cabecera.php'; ?>

  <section class="completo">
    <article class="centrado">
      <h1>Supermercados registrados</h1>

      <?php if ($resultados && count($resultados) > 0): ?>
        <table class="tabla">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Dirección</th>
              <th>Ciudad</th>
              <th>País</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($resultados as $fila): ?>
              <tr>
                <td><?= htmlspecialchars($fila['ID_Supermercado']) ?></td>
                <td><?= htmlspecialchars($fila['Nombre']) ?></td>
                <td><?= htmlspecialchars($fila['Direccion']) ?></td>
                <td><?= htmlspecialchars($fila['Ciudad']) ?></td>
                <td><?= htmlspecialchars($fila['Pais']) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php else: ?>
        <p>No hay supermercados registrados.</p>
      <?php endif; ?>

      <p><a href="<?= BASE_URL ?>/../sesiones/accesoUser.php">← Volver a mi perfil</a></p>
    </article>
  </section>

  <?php include_once __DIR__ . '/../includes/pie.html'; ?>
</body>
</html>
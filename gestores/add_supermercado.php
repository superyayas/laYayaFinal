<?php


include_once __DIR__ . '/../config.php';
include_once __DIR__ . '/../modelo/bdd/mysql.php';
include_once __DIR__ . '/../includes/funciones.php';

$mensaje = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 2. Recogida y validación básica
    $nombre   = trim($_POST['nombre'] ?? '');
    $direccion= trim($_POST['direccion'] ?? '');
    $ciudad   = trim($_POST['ciudad'] ?? '');
    $pais     = trim($_POST['pais'] ?? '');

    if ($nombre && $direccion && $ciudad && $pais) {
        // 3. Inserción en BBDD
        $sql = "INSERT INTO supermercado (Nombre, Direccion, Ciudad, Pais)
                VALUES (?, ?, ?, ?)";
        try {
          $ok = yayaBD::consultaInsercionBD(
              "INSERT INTO supermercado (Nombre, Direccion, Ciudad, Pais) VALUES (?, ?, ?, ?)",
              $nombre, $direccion, $ciudad, $pais
          );
          if ($ok) {
              $mensaje = "Supermercado \"$nombre\" añadido correctamente";
          }
      } catch (mysqli_sql_exception $e) {
          if ($e->getCode() === 1062) {
              // Duplicado en DIRECCION
              $mensaje = "Ya existe un supermercado con esa dirección.";
          } else {
              throw $e;
          }
        }
        yayaBD::cerrarConexion();
    } else {
        $mensaje = "Todos los campos son obligatorios.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Añadir supermercado</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>includes/styles.css">
</head>
<body>
  <?php include_once __DIR__ . '/../includes/cabecera.php'; ?>

  <h1>Añadir un nuevo supermercado</h1>

  <?php if ($mensaje): ?>
    <p class="mensaje"><?= htmlspecialchars($mensaje) ?></p>
  <?php endif; ?>

  <form action="" method="post">
    <label for="nombre">Nombre:</label><br>
    <input type="text" id="nombre" name="nombre" required><br><br>

    <label for="direccion">Dirección:</label><br>
    <input type="text" id="direccion" name="direccion" required><br><br>

    <label for="ciudad">Ciudad:</label><br>
    <input type="text" id="ciudad" name="ciudad" required><br><br>

    <label for="pais">País:</label><br>
    <input type="text" id="pais" name="pais" required><br><br>

    <input type="submit" value="Añadir supermercado">
  </form>

  <p><a href="<?= BASE_URL ?>/../sesiones/accesoUser.php">← Volver a mi perfil</a></p>

  <?php include_once __DIR__ . '/../includes/pie.html'; ?>
</body>
</html>

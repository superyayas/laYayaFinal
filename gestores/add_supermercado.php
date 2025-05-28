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
<main style="flex: 1;">
<section class="formulario-producto">
  <h2>Añadir un nuevo supermercado</h2>

      <?php if ($mensaje): ?>
        <p class="mensaje"><?= htmlspecialchars($mensaje) ?></p>
      <?php endif; ?>

      <form action="" method="post" class="form-add-producto">

        <input type="text" id="nombre" placeholder="Nombre del supermercado" name="nombre" required>

        <input type="text" id="direccion" placeholder="Dirección del supermercado" name="direccion" required>

        <input type="text" id="ciudad" placeholder="Ciudad del supermercado" name="ciudad" required>

        <input type="text" id="pais" placeholder="País del supermercado" name="pais" required>

        <input type="submit" value="Añadir Super">
      </form>
  <div class="boton-salir-container">
            <button onclick="location.href='<?= BASE_URL ?>/../sesiones/accesoUser.php'" class="boton-salir">← Volver a mi perfil</button>
  </div>
</section>
</main>

  <?php include_once __DIR__ . '/../includes/pie.html'; ?>
</body>
</html>

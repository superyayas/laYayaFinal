<?php
// sesiones/formulario.php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Regístrate</title>
  <link rel="stylesheet" href="../includes/styles.css">
</head>
<body>
  <?php include_once __DIR__ . '/../includes/cabecera.php'; 
  
  ?>

  <?php
    // Si venimos de un POST fallido, pre-llenamos
    $nombre    = $_POST['nombre']    ?? '';
    $apellidos = $_POST['apellidos'] ?? '';
    $usuario   = $_POST['usuario']   ?? '';
    $email     = $_POST['email']     ?? '';
    $contrasena= $_POST['contrasena']?? '';
  ?>
  <section class="completo">
    <article class="centrado">
      <h2>Regístrate</h2>
      <form action="confirmRegistro.php" method="post">
        <div>
          <label for="nombre">Nombre:</label>
          <input type="text" id="nombre" name="nombre"
                 value="<?= htmlspecialchars($nombre) ?>" required>
        </div>
        <div>
          <label for="apellidos">Apellidos:</label>
          <input type="text" id="apellidos" name="apellidos"
                 value="<?= htmlspecialchars($apellidos) ?>" required>
        </div>
        <div>
          <label for="usuario">Usuario:</label>
          <input type="text" id="usuario" name="usuario"
                 value="<?= htmlspecialchars($usuario) ?>" required>
        </div>
        <div>
          <label for="email">Email:</label>
          <input type="email" id="email" name="email"
                 value="<?= htmlspecialchars($email) ?>" required>
        </div>
        <div>
          <label for="contrasena">Contraseña:</label>
          <input type="password" id="contrasena" name="contrasena"
                 value="<?= htmlspecialchars($contrasena) ?>" required>
        </div>
        <div>
          <button type="submit">Enviar</button>
        </div>
      </form>
    </article>
  </section>

  <?php include_once __DIR__ . '/../includes/pie.html'; ?>
</body>
</html>

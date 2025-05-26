<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Formulario de acceso</title>
  <link rel="stylesheet" href="styles.css">
  <?php include "cabecera.php"; ?>
</head>
<body>

<div class="formulario-login-container">
  <h2>Formulario de Acceso</h2>

  <form action="../sesiones/controlSesiones/validarSesion.php" method="POST">
    <div class="form-grupo">
      <label for="usuario">Usuario:</label>
      <input type="text" name="usuario" id="usuario" required />
    </div>

    <div class="form-grupo">
      <label for="contrasena">Clave:</label>
      <input type="password" name="contrasena" id="contrasena" required />
    </div>

    <div class="form-boton-centrado">
      <button type="submit" class="botonForm botonForm-enviar">Acceder</button>
      <a href="formulario.php" class="botonForm botonForm-volver">Nuevo Registro</a>
    </div>
  </form>
</div>

<?php include "pie.html"; ?>
</body>
</html>



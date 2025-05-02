<?php
// sesiones/confirmRegistro.php
session_start();
include_once __DIR__ . '/../includes/funciones.php';
$datos = parametros();  
// parametros() debe devolver: [nombre, apellidos, usuario, email, contrasena, true|false]
if (!($datos && $datos[5])) {
    // Si faltan datos, volvemos al formulario
    header('Location: formulario.php');
    exit;
}
list($nombre, $apellidos, $usuario, $email, $contrasena, $ok) = $datos;
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Confirmación Datos</title>
  <link rel="stylesheet" href="../includes/styles.css">
</head>
<body>
  <?php include_once __DIR__ . '/../includes/cabecera.php'; ?>

  <section class="completo">
    <article class="centrado">
      <h2>Confirma tus datos</h2>
      <form action="altaUsuario.php" method="post">
        <!-- Ocultamos los valores para reenviarlos -->
        <input type="hidden" name="nombre"     value="<?= htmlspecialchars($nombre) ?>">
        <input type="hidden" name="apellidos"  value="<?= htmlspecialchars($apellidos) ?>">
        <input type="hidden" name="usuario"    value="<?= htmlspecialchars($usuario) ?>">
        <input type="hidden" name="email"      value="<?= htmlspecialchars($email) ?>">
        <input type="hidden" name="contrasena" value="<?= htmlspecialchars($contrasena) ?>">

        <p><strong>Nombre:</strong>     <?= htmlspecialchars($nombre) ?></p>
        <p><strong>Apellidos:</strong>  <?= htmlspecialchars($apellidos) ?></p>
        <p><strong>Usuario:</strong>    <?= htmlspecialchars($usuario) ?></p>
        <p><strong>Email:</strong>      <?= htmlspecialchars($email) ?></p>
        <p><strong>Contraseña:</strong> <?= htmlspecialchars($contrasena) ?></p>

        <div>
          <button type="submit">Confirmar</button>
          <button type="submit"
          formaction="formulario.php"
          formmethod="post">
            Corregir
          </button>
        </div>
      </form>
    </article>
  </section>

  <?php include_once __DIR__ . '/../includes/pie.html'; ?>
</body>
</html>
<?php
include_once __DIR__ . '/../includes/funciones.php';
include_once __DIR__ . '/../modelo/bdd/mysql.php';

$datos = parametros();
if (!($datos && $datos[5])) {
    header('Location: formulario.php');
    exit;
}
list($nombre, $apellidos, $usuario, $email, $contrasena, $ok) = $datos;

$hash = password_hash($contrasena, PASSWORD_DEFAULT);
$sql = "INSERT INTO usuario
        (Nombre, Apellidos, Usuario, CorreoElectronico, contrasena)
        VALUES (?, ?, ?, ?, ?)";

try {
    // Intenta la inserción
    $insert = yayaBD::consultaInsercionBD(
        $sql, $nombre, $apellidos, $usuario, $email, $hash
    );
} catch (mysqli_sql_exception $e) {
    // Código 1062 = entrada duplicada en clave única
    if ($e->getCode() === 1062) {
        $insert   = false;
        $errorMsg = "El nombre de usuario o el correo ya están en uso.";
    } else {
        // Para otros errores, volver a lanzarlo (o manejarlo a tu gusto)
        throw $e;
    }
}
yayaBD::cerrarConexion();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Alta Usuario</title>
  <link rel="stylesheet" href="../includes/styles.css">
</head>
<body>
  <?php include_once __DIR__ . '/../includes/cabecera.php'; ?>
<main style="flex: 1;">
  <?php if ($insert): ?>
  <!--  USUARIO INSERTADO CORRECTAMENTE -->
  <section class="completo">
    <article class="centrado">
      <h1>Usuario creado satisfactoriamente</h1>
      <div class="cuadro-usuario-creado">
        <p>El usuario <strong><?= htmlspecialchars($usuario) ?></strong> ha sido registrado.</p>
      </div>
      <div class="form-boton-centrado">
        <a href="../index.php" class="boton-altaUsuario">Volver al inicio</a>
      </div>
    </article>
  </section>
<?php else: ?>
  <!--  ERROR AL CREAR USUARIO -->
  <section class="completo">
    <article class="centrado">
      <h1><?= isset($errorMsg) ? htmlspecialchars($errorMsg) : 'Error al crear el usuario' ?></h1>
      <div class="form-boton-centrado">
        <a href="formulario.php" class="botonForm botonForm-volver">← Volver al formulario</a>
      </div>
    </article>
  </section>
<?php endif; ?>
</main>

  <?php include_once __DIR__ . '/../includes/pie.html'; ?>
</body>
</html>

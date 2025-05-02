<?php
// gestores/gestor_supermercado.php
session_start();
include_once "../includes/funciones.php";
include_once "../modelo/bdd/mysql.php";

$error = '';
$exito = false;

// Si viene del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Tu función parametros() debe leer directamente de $_POST:
    $datos = parametros();  
    if (is_array($datos) && count($datos) === 4) {
        list($Nombre, $Direccion, $Cuidad, $Pais) = $datos;

        // Usamos parámetros preparados en tu wrapper:
        $sql = "INSERT INTO supermercado
                  (Nombre, Direccion, Cuidad, Pais)
                VALUES (?, ?, ?, ?)";
        $ok = yayaBD::consultaInsercionBD(
            $sql,
            $Nombre,
            $Direccion,
            $Cuidad,
            $Pais
        );
        yayaBD::cerrarConexion();

        if ($ok) {
            $exito = true;
        } else {
            $error = "Error al crear el supermercado en la base de datos.";
        }
    } else {
        $error = "Faltan datos obligatorios para crear el supermercado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Supermercados</title>
  <link rel="stylesheet" href="../styles.css">
</head>
<body>
  <?php if ($exito): ?>
    <section class="completo">
      <article class="centrado">
        <h1>Supermercado creado exitosamente</h1>
        <p>El supermercado <strong><?= htmlspecialchars($Nombre) ?></strong> ha sido creado.</p>
        <a href="../sesiones/accesoUser.php">Volver a mi perfil</a>
      </article>
    </section>
<?php endif; 
?>
</body>
</html>
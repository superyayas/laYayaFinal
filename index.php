<?php session_start();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaYaya</title>
    <link rel="stylesheet" href="includes/styles.css">
</head>
<body>

<?php
//Index sin  logear
if (!isset($_SESSION['usuario'])):
include 'includes/cabecera.php';
?>
<?php
include 'includes/login.php';
?>

<?php
include 'includes/pie.html';
//Index si se ha logeado
else:
    include 'includes/cabecera.php';
    include 'includes/funciones.php';
// Establece el tiempo máximo de vida de la sesión (30 minutos en segundos)
$tiempo_maximo = 30 * 60; // 30 minutos



// Comprobar si la sesión ha caducado
if (time() - $_SESSION['tiempo'] > $tiempo_maximo) {
    // Destruir la sesión si ha pasado más de 30 minutos
    session_unset(); // Eliminar todas las variables de sesión
    session_destroy(); // Destruir la sesión
    header("Location: index.php"); // Redirigir al usuario al login o página que elijas
    exit();
}
// Actualizar el tiempo de inicio en cada actividad si la sesión sigue activa
$_SESSION['tiempo_inicio'] = time();
?>
<div>
Usuario: "<?php echo $_SESSION['usuario'];?>"&nbsp;&nbsp;&nbsp;&nbsp;Sesion iniciada a las 
<?php echo date("d/m/Y G:i:s",$_SESSION['tiempo']);?>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="sesiones/controlSesiones/cerrarSesion.php" class="enlace_sesion">Cerrar sesión</a>

</div>


			
<?php
include "includes/pie.html";
endif;
?>
</body>
</html>
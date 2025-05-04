<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $nombre = htmlspecialchars($_POST["nombre"]);
    $email = htmlspecialchars($_POST["email"]);
    $asunto = htmlspecialchars($_POST["asunto"]);
    $mensajeUsuario = htmlspecialchars($_POST["mensaje"]);

    // Crear el mensaje personalizado
    $mensaje = "Apreciado/a " . $nombre . ", con la solicitud de: " . $asunto . ", con email " . $email . ", nos pondremos en contacto con usted lo antes posible. ¡Gracias!.";

} else {
    // Si se entra sin formulario, redirige
    header("Location: contacto.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mensaje enviado - La Yaya</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php include 'cabecera.php'; ?>

<section class="seccion-contacto">
    <h2>Mensaje enviado correctamente</h2>
    <p><?= $mensaje ?></p>
    <br>
    <a href="../index.php">Volver a la página de inicio</a>
</section>

<?php include 'pie.html'; ?>

</body>
</html>



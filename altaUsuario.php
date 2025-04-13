<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Registro</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php

    include_once "includes/funciones.php";
    include_once "modelo/bdd/mysql.php";
    // Llamamos al método que contiene los datos del usuario
    list($nombre,$apellidos,$usuario,$email,$contrasena,$contenido) = parametros();
    if($contenido) :
    $hash = hash('sha256',$contrasena);
    // Variable que permita registrar al usuario en la BDD
    $consulta = "INSERT INTO `usuario`(`Nombre`, `Apellidos`,`Usuario`,`CorreoElectronico`,`contrasena`) VALUES ('$nombre','$apellidos','$usuario','$email','$hash')";
    $prueba = yayaBD::consultaInsercionBD($consulta);
    if ($prueba):

    ?>
<section class="completo">
    <article class="centrado">
        <h1>Usuario creado satisfactoriamente</h1>
        <p>El usuario <?php echo $usuario; ?> ha sido creado.</p>
        <p><?php echo $nombre; ?></p>
        <p> <?php echo $apellidos; ?></p>
        <p> <?php echo $usuario; ?></p>
        <a href="index.php"> Volver a inicio</a>
    </article>
</section>
<?php
else : 
    echo "<h1>Error en la creación de usuario</h1>";
endif;
else : 
    echo "<h1>Error en la recepción de los datos</h1>";
endif;
yayaBD::cerrarConexion();

?>
<?php
    include "includes/pie.html";
    ?>
</body>
</html>
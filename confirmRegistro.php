<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación Datos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    
<?php
include_once "includes/funciones.php";
list($nombre,$apellidos,$usuario,$email,$contrasena,$contenido) = parametros();

if($contenido) :
?>

<h2>Formulario de Registro</h2>
        <form action="altaUsuario.php" method="post">
            <div>
                <label for="nombre">Nombre: <?php echo $nombre; ?></label>
                <input type="hidden" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>
            </div>

            <div>
                <label for="apellidos">Apellidos: <?php echo $apellidos; ?></label>
                <input type="hidden" id="apellidos" name="apellidos" value="<?php echo $apellidos; ?>" required>
            </div>

            <div>
                <label for="usuario">Usuario: <?php echo $usuario; ?></label>
                <input type="hidden" id="usuario" name="usuario" value="<?php echo $usuario; ?>" required>
            </div>
        
            <div>
                <label for="email">Email: <?php echo $email; ?></label>
                <input type="hidden" id="email" name="email" value="<?php echo $email;?>" required>
            </div>
<br>
            <div>
                <label for="contrasena">Contraseña:<?php echo $contrasena; ?></label>
                <input type="hidden" id="contrasena" name="contrasena" value="<?php echo $contrasena; ?>" required>
            </div>
<br>
            <div>
                <button type="submit">Confirmar Datos</button>
                <button type="submit" formaction="registro.php">Corregir Datos</button>

            </div>
        </form>

<?php
else:
    echo "<h1>Error en los datos</h1>";
endif;
?>
<?php
    include "includes/pie.html";
    ?>
</body>
</html>

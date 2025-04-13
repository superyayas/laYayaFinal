<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrate</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php

if (isset($_POST['nombre']) && isset($_POST['apellidos']) && isset($_POST['telefono']) && isset($_POST['email']) && isset($_POST['contrasena']) ){
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$contrasena = $_POST['contrasena'];
?>

<section class="completo">
    <article class="centrado">
        <h2>Registrate</h2>
        <form action="confirmRegistro.php" method="post">
            <div >
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $nombre ?>" required>
            </div>

            <div >
                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" value="<?php echo $apellidos ?>" required>
            </div>

            <div >
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" value="<?php echo $usuario ?>" required>
            </div>

            <div >
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="<?php echo $email ?>" required>
            </div>

            <div >
                <label for="contrasena">Contraseña:</label>
                <input type="text" id="contrasena" name="contrasena" value="<?php echo $contrasena ?>" required>
            </div>

            <div >
                <button type="submit">Enviar</button>
            </div>
        </form>
    </article>
</section>

<?php
} else {
    ?>
<section class="completo">
    <article class="centrado">
        <h2>Introduce los datos para registrarte</h2>
        <form action="confirmRegistro.php" method="post">
            <div >
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>

            <div >
                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" required>
            </div>

            <div >
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" required>
            </div>

            <div >
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" required>
            </div>

            <div >
                <label for="contrasena">Contraseña:</label>
                <input type="text" id="contrasena" name="contrasena" required>
            </div>

            <div >
                <button type="submit">Enviar</button>
            </div>
        </form>
    </article>
</section>
<?php
}
?>
    <?php
    include "includes/pie.html";
    ?>
</body>
</html>
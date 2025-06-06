<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrate</title>
    <link rel="stylesheet" href="styles.css">
    <?php
    include "cabecera.php";
    ?>
</head>
<body>
   <main style="flex: 1;"> 
    <div class="formulario-registro-container">
        <h2>Formulario de Registro</h2>
        <form action="../sesiones/confirmRegistro.php" method="post">
            <div>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>

            <div>
                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" required>
            </div>

            <div>
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" required>
            </div>

            <div>
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" required>
            </div>

            <div>
                <label for="contrasena">Contraseña:</label>
                <input type="text" id="contrasena" name="contrasena" required>
            </div>

            <div>
                 <div class="form-boton-centrado">
                    <button type="submit" class="botonForm botonForm-enviar">Enviar</button>
                </div>
            </div>
        </form>
    </div>
   </main>
     <?php
  include "pie.html";
  ?>

</body>
</html>
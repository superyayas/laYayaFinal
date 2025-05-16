<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Formulario de acceso</title>
	<link rel="stylesheet" href="styles.css">
	<?php
    include "cabecera.php";
    ?>
</head>
<body>

<section class="completo">
    <article class="centrado">
	
	<form action="../sesiones/controlSesiones/validarSesion.php" method="POST">
	<h2>Formulario de Acceso</h2>
    <div class="formulario-conjunto">
	<label>Usuario:</label>
	<input type="text" name="usuario"/>
</div>
<div class="formulario-conjunto">
	<label>Clave:</label>
	<input type="password" name="contrasena"/>
</div>
<div class="formulario-conjunto">
	<input type="submit" value="Acceder"/>
</div>
	</form>
    <a href="includes/formulario.php">Nuevo Registro</a>
</article>
</section>
</body>
</html>



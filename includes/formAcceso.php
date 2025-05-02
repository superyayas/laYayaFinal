<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<?php
	include "cabecera.php";
	?>
	<section class="completo">
		<article class="centrado">
		
			<form action="login.php" method="POST">
				<h2>Formulario de Acceso</h2>
				<div class="formulario-conjunto">
					<label>Usuario:</label>
						<input type="text" name="usuario"/>
					<label>Clave:</label>
						<input type="contrasena" name="contrasena"/>
				<input type="submit" value="Acceder"/>
				</div>
			</form>
		</article>
	</section>
</body>
<?php
	include "pie.html";
	?>
</html>


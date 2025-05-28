
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Contacto - La Yaya</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php include 'cabecera.php'; ?>
<main style="flex: 1;">
<section class="seccion-contacto">
  <h2>Formulario de Contacto</h2>
  
  <form action="procesarContacto.php" method="post" class="form-contacto">
    <input type="text" name="nombre" placeholder="Nombre y Apellidos" required>
    <input type="email" name="email" placeholder="Correo electrónico" required>
    <input type="text" name="asunto" placeholder="Asunto" required>
    <textarea name="mensaje" placeholder="Escribe tu mensaje aquí..." required></textarea>
    <input type="submit" value="Enviar">
  </form>
  <div class="boton-salir-container">
  <button type="button" onclick="window.location.href='../index.php'" class="boton-salir">Salir</button>
</div>
</section>
</main>
 <?php
  include "pie.html";
  ?>

</body>
</html>

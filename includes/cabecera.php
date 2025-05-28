<?php
include_once __DIR__ . '/../config.php';


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
    $tiempo_maximo = 30 * 60;

    // Si ya existe un registro de tiempo en sesión, compruebo caducidad
    if (isset($_SESSION['tiempo'])) {
        if (time() - $_SESSION['tiempo'] > $tiempo_maximo) {
            // Caducada: limpio y destruyo
            session_unset();
            session_destroy();
            header("Location:" . BASE_URL ."index.php"); // Redirige index
            exit();
        }
    }
    $_SESSION['tiempo'] = time();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="<?= BASE_URL ?>includes/styles.css">

</head>
<body>
  <header>

        <div class="logo">
            <img src="<?= BASE_URL ?>includes/img/logo.png" alt="Logo">
          </div>
          <input type="text" id="buscador" placeholder="Buscar producto...">
        <button class="search-btn" onclick="buscador()" aria-label="Buscar">
                 <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24" height="24"
                viewBox="0 0 24 24"
                role="img"
                aria-hidden="true"
              >
                <title>Ícono de búsqueda</title>
                <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0016 
                        9.5 6.5 6.5 0 109.5 16c1.61 0 3.09-.59 
                        4.23-1.57l.27.28v.79l5 4.99L20.49 
                        19l-4.99-5zm-6 0C8.01 14 6 11.99 6 
                        9.5S8.01 5 10.5 5 15 7.01 15 
                        9.5 12.99 14 10.5 14z"/>
              </svg>
        </button>
        

  
    <?php if (!isset($_SESSION['usuario'])): ?>
      <!-- Cabecera para invitado -->
      <nav>
        <a href="<?= BASE_URL ?>index.php">Inicio</a>
        <a href="<?= BASE_URL ?>includes/login.php">Iniciar sesión</a>
        <a href="<?= BASE_URL ?>includes/formulario.php">Registro</a>
        <a href="<?= BASE_URL ?>includes/contacto.php">Contacto</a>

        
      </nav>
    <?php else: ?>
      <!-- Cabecera para usuario loggeado -->
      <nav>
        <a href="<?= BASE_URL ?>index.php">Inicio</a>
        <a href="<?= BASE_URL ?>sesiones/accesoUser.php"> Sesión de: <?= htmlspecialchars($_SESSION['usuario'])?></a>
        <a href="<?= BASE_URL ?>includes/contacto.php">Contacto</a>
        <a href="<?= BASE_URL ?>sesiones/controlSesiones/cerrarSesion.php">Cerrar sesión</a>
        
      </nav>
    <?php endif; ?>
   <script>
    window.BASE_URL = '<?= BASE_URL ?>';
  </script>

  <script src="<?= BASE_URL ?>includes/scripts.js" defer></script>
  </header>


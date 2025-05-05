<?php
include_once __DIR__ . '/../config.php';

//SIEMPRE QUE TENGAMOS QUE PONER LA CABECERA DEBEMOS DE INCLUIR EL COMANDO SESSION_STAR()
session_start();
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
</head>
<body>
  <header>

         <div class="logo">
            <img src="<?= BASE_URL ?>includes/img/logo.png" alt="Logo">
            <script src="<?= BASE_URL ?>/scripts.js"></script>
        </div>
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
  </header>


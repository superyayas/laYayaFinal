<?php
include_once __DIR__ . '/../config.php';
?>

    <header class="header">
        <div class="logo">
            <img src="<?= BASE_URL ?>includes/img/logo.png" alt="Logo">
            <script src="<?= BASE_URL ?>includes/scripts.js"></script>

        </div>
        <nav class="menu">
               <input id="buscador" type="search" placeholder="Buscar…">
            <ul>
                <li><a href="<?= BASE_URL ?>includes/formAcceso.php">Entrar</a></li>
                <li><a href="<?= BASE_URL ?>sesiones/formulario.php">Registrate</a></li>
                <li><a href="#">Contacto</a></li>
            </ul>
        </nav>
    </header>

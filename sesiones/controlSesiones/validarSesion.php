<?php
// sesiones/controlSesiones/validarUsuario.php
session_start();
include_once __DIR__ . "/../../modelo/bdd/mysql.php";

// Mostrar errores en desarrollo
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!empty($_POST['usuario']) && !empty($_POST['contrasena'])) {
    $user = trim($_POST['usuario']);
    $pass = $_POST['contrasena'];

    // Consulta preparada leyendo solo lo que necesitamos
    $sql  = "SELECT Usuario, contrasena, Rol 
             FROM usuario 
             WHERE Usuario = ?";
    $rows = yayaBD::consultaLectura($sql, $user);
    yayaBD::cerrarConexion();

    if ($rows) {
        $hash = $rows[0]['contrasena'];

        // Verificamos con password_verify el hash generado en altaUsuario.php
        if (password_verify($pass, $hash)) {
            // Autenticación correcta
            $_SESSION['usuario'] = $rows[0]['Usuario'];
            $_SESSION['rol']     = $rows[0]['Rol'];
            $_SESSION['tiempo']  = time();

            // Redirección limpia
            header("Location: ../../index.php");
            exit;
        } else {
            echo "<h1>La contraseña es incorrecta.</h1>";
        }
    } else {
        echo "<h1>El usuario no existe.</h1>";
    }
} else {
    echo "<h1>No se han recibido datos de usuario y/o contraseña.</h1>";
}
?>
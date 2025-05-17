<?php
//Método para recoger los datos del usuario
function parametros(){
    if (isset($_POST['nombre']) && isset($_POST['apellidos']) && isset($_POST['usuario']) && isset($_POST['email'])&& isset($_POST['contrasena']) ){
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $usuario = $_POST['usuario'];
        $email = $_POST['email'];
        $contrasena = $_POST['contrasena'];
    $contenido = true;
return [$nombre,$apellidos,$usuario,$email,$contrasena,$contenido];
    }else{
        $contenido = false;
        return $contenido;
    }
}
function productos() {
    if (isset($_POST['nombre_producto'], $_POST['descripcion'], $_POST['precio'], $_POST['id_categoria'], $_POST['marca'])) {
        $nombre_producto = trim($_POST['nombre_producto']);
        $descripcion     = trim($_POST['descripcion']);
        $precio          = floatval($_POST['precio']);
        $id_categoria    = intval($_POST['id_categoria']);
        $marca           = trim($_POST['marca']);
        return [$nombre_producto, $descripcion, $id_categoria, $marca, $precio]; // Solo 5 valores reales
    }
    return false;
}

function conectarBD() {
    $conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }
    return $conexion;
}

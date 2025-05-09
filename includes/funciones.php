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
function productos(){
    if (isset($_POST['nombre_producto']) && isset($_POST['descripcion']) && isset($_POST['precio']) && isset($_POST['id_categoria']) &&
    isset($_POST['marca']) ){
        $nombre_producto = $_POST['nombre_producto'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $id_categoria = $_POST['id_categoria'];
        $marca = $_POST['marca'];
    $contenido = true;
return [$nombre_producto,$descripcion,$id_categoria,$marca,$precio,$contenido];
    }else{
        $contenido = false;
        return $contenido;
    }
}
function conectarBD() {
    $conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }
    return $conexion;
}

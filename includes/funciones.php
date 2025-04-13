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
    if (isset($_POST['nombreProducto']) && isset($_POST['descripcion']) && isset($_POST['precio']) && isset($_POST['cantidad']) ){
        $nombreProducto = $_POST['nombreProducto'];
        $descripcion = $_POST['descripcion'];
        $id_categoria = $_POST['id_categoria'];
        $marca = $_POST['marca'];
    $contenido = true;
return [$nombre_producto,$descripcion,$id_categoria,$marca,$contenido];
    }else{
        $contenido = false;
        return $contenido;
    }
}
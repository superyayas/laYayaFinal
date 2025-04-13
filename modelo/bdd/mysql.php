<?php
class yayaBD{
    private static $conexion = null;

    //Crear conexión a la BDD
    private static function conexionBD(){
        $config = parse_ini_file(__DIR__ . "/../../config.ini");
        //Comprobar si la contraseña esta vacía
        $pass = $config['contrasena'] ?? '';
        if(self::$conexion === null){
            self::$conexion = new mysqli($config['server'], $config['user'],$pass,$config['bd']);
            //Comprobaremos que la conexión se ha realizado con éxito
        if (self::$conexion->connect_error){
            die("Error en la conexión: " . self::$conexion->connect_error);
        }
        self::$conexion->set_charset('utf8');
        }
        return self::$conexion;
    }
    //Método para insertar datos en la BDD
    public static function consultaInsercionBD($consulta){
        $conexion = self::conexionBD();
        if($conexion->query($consulta)){
            return true;
        }else{
            return false;
        }
    }
    private static function info($conexion,$consulta,...$parametros){
        $informacion = $conexion->prepare($consulta);
        if($parametros){
            $tipos='';
            foreach($parametros as $parametro){
                $tipos .= is_int($parametro) ? 'i' : 's';
            }
            $informacion->bind_param($tipos,...$parametros);
    }
    return $informacion;
}
    //Método para la lectura de datos de la BDD
    public static function consultaLectura($consulta,...$parametros){
        $conexion = self::conexionBD();
        $resultado = $conexion->query($consulta);

        if ($resultado->num_rows > 0){
            return $resultado->fetch_all(MYSQLI_ASSOC);
        }else{
            return null;
        }
        
    }
    /*
    //Metodo para la actualización de datos de los clientes
    public function actualizarCliente($id,$nombre,$apellidos,$telefono,$email,$contrasena){
        $consulta = "UPDATE `usuario` SET `Nombre` =?,`Apellidos` =?,'Usuario` =?, 'CorreoElectronico` =?,`contrasena` =? WHERE `id` =?";
        $actualizar = yayaBD::consultaInsercionBD($consulta,$nombre,$apellidos,$usuario,$email,$contrasena,$id);
        return $actualizar;
    }*/

    //Método para cerrar la conexión a la BDD
    public static function cerrarConexion(){
        //Si la conexión NO esta cerrada, la diremos que lo haga
        if (self::$conexion !== null){
            self::$conexion->close();
            self::$conexion = null;
        }
    }
}
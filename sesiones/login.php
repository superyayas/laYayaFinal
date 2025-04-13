<?php session_start(); ?>

<?php
require_once "../modelo/bdd/mysql.php";
if (isset($_POST['usuario']) && isset($_POST['contrasena'])){
	$user = $_POST['usuario'];
	$consulta = "SELECT * FROM `usuario` WHERE `Usuario` = '$user'";
	$resultado = yayaBD::consultaLectura($consulta);
	if($resultado != null){
		$contrasena = hash('sha256',$_POST['contrasena']);
		if(($resultado[0]['Usuario']== $user)&&($resultado[0]['contrasena']== $contrasena)){
			$_SESSION['usuario']="$user";
			$_SESSION['tiempo']=time();
		
			header("Location: accesoUser.php");
			exit();
			
		} else if ($user=="admin" && $passw == hash ('sha256',"abcdef") ){ 
            $_SESSION['usuario']="$user";
			$_SESSION['tiempo']=time();
            header("Location: ../accesoAdmin.php");
			exit();
            
        } else {
            echo "<h1>La contraseña es incorrecta.</h1>";
        }
    } else {
        echo "<h1>El usuario no existe.</h1>";
    }
} else {
    echo "<h1>No se han recibido datos.</h1>";
}
yayaBD::cerrarConexion();
?>
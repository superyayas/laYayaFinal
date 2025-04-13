<?php

// He utilizado require_once __DIR__ porque solo con require_once me estaba dando errores de localización
// del archivo
require_once __DIR__. '/../modelo/yayaModelo.php';
class yayaController    {
    private $modelo;
    public function __construct(){ 
        $this->modelo = new yayaModelo();
    }
    
    // Función para obtener el contenido del archivo xml a traves del constructor de la classe creada arriba
    public function listadoProductos(){
        $productos = $this->modelo->mostrarProductos();
        require_once __DIR__. '/../vista/productosView.php';
    }
}
?>
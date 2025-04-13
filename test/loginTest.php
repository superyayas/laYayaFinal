<?php

use PHPUnit\Framework\TestCase;
require_once "funciones.php";

class loginTest extends TestCase
{

    public function testParametros(){

        $param = new Login();
        $valor= $param->parametros();

        $this->assertEquals($param->parametros() , true);

    }

}
?>
<?php

use PHPUnit\Framework\TestCase;

final class ConexionTest extends TestCase
{
    public function testConexionBaseDeDatos()
    {
        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $db   = 'la_yaya';

        $conexion = new \mysqli($host, $user, $pass, $db);

        if ($conexion->connect_error) {
            $this->fail('❌ Error de conexión: ' . $conexion->connect_error);
        }

        $this->assertInstanceOf(\mysqli::class, $conexion, '❌ No se pudo establecer la conexión con la base de datos');
    }
}


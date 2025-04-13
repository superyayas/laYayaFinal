<?php

use PHPUnit\Framework\TestCase;

final class AltaUsuarioTest extends TestCase
{
    public function testAltaUsuarioCorrectamente()
    {
        // Simulamos los datos del formulario
        $_POST['nombre'] = 'Juan';
        $_POST['apellidos'] = 'Pérez';
        $_POST['telefono'] = '123456789';
        $_POST['email'] = 'juan@example.com';
        $_POST['contrasena'] = 'clave123';
        $_POST['contenido'] = true;

        // Iniciamos un buffer de salida
        ob_start();
        include __DIR__ . '/../../app/altaUsuario.php';
        $output = ob_get_clean();

        // Validamos que el texto esperado esté en la salida
        $this->assertStringContainsString('Usuario creado satisfactoriamente', $output);
        $this->assertStringContainsString('Juan', $output);
        $this->assertStringContainsString('Pérez', $output);
    }

    public function testAltaUsuarioSinDatos()
    {
        $_POST = []; // sin datos simulados

        ob_start();
        include __DIR__ . '/../../app/altaUsuario.php';
        $output = ob_get_clean();

        $this->assertStringContainsString('Error en la recepción de los datos', $output);
    }
}

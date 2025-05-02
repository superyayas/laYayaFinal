<?php

use PHPUnit\Framework\TestCase;

final class ConexionTest extends TestCase
{
    public function testIngresoProducto()
   {
    $nombre = 'Producto de Prueba';
    $descripcion = 'Descripción de prueba del producto.';
    $idCategoria = 1; // Asegúrate de que exista esta categoría en la tabla Categoria
    $marca = 'MarcaTest';

    try {
    $stmt = $pdo->prepare(
        "INSERT INTO Producto (NombreProducto, Descripcion, ID_Categoria, Marca)
         VALUES (:nombre, :descripcion, :categoria, :marca)"
    );
    $stmt->execute([
        ':nombre'      => $nombre,
        ':descripcion' => $descripcion,
        ':categoria'   => $idCategoria,
        ':marca'       => $marca,
    ]);
    echo "Prueba completada: Producto insertado correctamente. ID generado: " . $pdo->lastInsertId();
} catch (PDOException $e) {
    echo "Error en la prueba de inserción: " . htmlspecialchars($e->getMessage());
}
   }
    }
?>

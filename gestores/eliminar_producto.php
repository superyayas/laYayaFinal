<?php
include_once __DIR__ . '/../config.php';
include_once __DIR__ . '/../modelo/bdd/mysql.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['ID_Producto'] ?? null;
    if ($id) {
        // Primero eliminamos el precio relacionado
        $sql1 = "DELETE FROM precioproducto WHERE ID_Producto = ?";
        yayaBD::consultaInsercionBD($sql1, (int)$id);

        // Luego eliminamos el producto
        $sql2 = "DELETE FROM producto WHERE ID_Producto = ?";
        yayaBD::consultaInsercionBD($sql2, (int)$id);
    }
}

yayaBD::cerrarConexion();
header('Location: listar_productos.php');
exit;


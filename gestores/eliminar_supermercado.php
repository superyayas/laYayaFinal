<?php
include_once __DIR__ . '/../config.php';
include_once __DIR__ . '/../modelo/bdd/mysql.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    if ($id) {
        $sql = "DELETE FROM supermercado WHERE ID_Supermercado = ?";
        yayaBD::consultaInsercionBD($sql, (int)$id);
    }
}

yayaBD::cerrarConexion();
header('Location: listar_supermercado.php');
exit;

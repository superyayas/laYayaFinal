<?php
include_once __DIR__ . '/../config.php';
include_once __DIR__ . '/../modelo/bdd/mysql.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['ID_Supermercado'] ?? null;
        if ($id) {
            $sql = "DELETE FROM supermercado WHERE ID_Supermercado = ?";
            yayaBD::consultaInsercionBD($sql, (int)$id);
        }
    }

    yayaBD::cerrarConexion();
    // Redirigir con éxito
    header('Location: listar_supermercado.php?exito=1');
    exit;

} catch (mysqli_sql_exception $e) {
    yayaBD::cerrarConexion();

    // Si el error es por clave foránea (código 1451)
    if ($e->getCode() === 1451) {
        header('Location: listar_supermercado.php?error=relaciones');
    } else {
        header('Location: listar_supermercado.php?error=general');
    }
    exit;
}

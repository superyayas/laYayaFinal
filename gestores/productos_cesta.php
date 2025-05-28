<?php
session_start();

if (isset($_POST['ID_Producto'])) {
    $id_producto = intval($_POST['ID_Producto']);

    if (!isset($_SESSION['cesta'])) {
        $_SESSION['cesta'] = [];
    }

    if (isset($_SESSION['cesta'][$id_producto])) {
        $_SESSION['cesta'][$id_producto]++;
    } else {
        $_SESSION['cesta'][$id_producto] = 1;
    }
}

header('Location: listar_productos.php');
exit;

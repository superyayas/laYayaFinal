<?php
session_start();

$id_producto = intval($_POST['ID_Producto']);
$cesta_numero = intval($_POST['cesta']); // 1 o 2

$nombre_cesta = "cesta" . $cesta_numero;

if (!isset($_SESSION[$nombre_cesta])) {
    $_SESSION[$nombre_cesta] = [];
}

if (isset($_SESSION[$nombre_cesta][$id_producto])) {
    $_SESSION[$nombre_cesta][$id_producto]++;
} else {
    $_SESSION[$nombre_cesta][$id_producto] = 1;
}

header("Location: listar_productos.php");
exit;

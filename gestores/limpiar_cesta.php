<?php
session_start();

if (isset($_POST['cesta'])) {
    if ($_POST['cesta'] === '1') {
        unset($_SESSION['cesta1']);
    } elseif ($_POST['cesta'] === '2') {
        unset($_SESSION['cesta2']);
    } elseif ($_POST['cesta'] === 'todas') {
        unset($_SESSION['cesta1']);
        unset($_SESSION['cesta2']);
    }
}

header('Location: cesta.php');
exit;
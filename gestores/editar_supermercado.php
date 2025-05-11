<?php
include_once __DIR__ . '/../config.php';
include_once __DIR__ . '/../modelo/bdd/mysql.php';

// Obtener ID
$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: listar_supermercado.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Procesar actualización
    $nombre    = trim($_POST['nombre']);
    $direccion = trim($_POST['direccion']);
    $ciudad    = trim($_POST['ciudad']);
    $pais      = trim($_POST['pais']);

    $sql = "UPDATE supermercado
            SET Nombre = ?, Direccion = ?, Ciudad = ?, Pais = ?
            WHERE ID_Supermercado = ?";
    yayaBD::consultaInsercionBD($sql, $nombre, $direccion, $ciudad, $pais, (int)$id);
    yayaBD::cerrarConexion();
    header('Location: listar_supermercado.php');
    exit;
}

// Cargar datos actuales
$sql = "SELECT Nombre, Direccion, Ciudad, Pais FROM supermercado WHERE ID_Supermercado = ?";
$datos = yayaBD::consultaLectura($sql, (int)$id)[0] ?? null;
if (!$datos) {
    header('Location: listar_supermercado.php');
    exit;
}

yayaBD::cerrarConexion();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Supermercado</title>
<link rel="stylesheet" href="<?= BASE_URL ?>includes/styles.css">
</head>
<body>
    <?php include_once __DIR__ . '/../includes/cabecera.php'; ?>
  <h2>Editar Supermercado</h2>
  <p><strong>ID:</strong> <?= htmlspecialchars($id) ?></p>
  <p><strong>Nombre actual:</strong> <?= htmlspecialchars($datos['Nombre']) ?></p>
  <form method="post" action="">
    <label>Nombre:<br><input type="text" name="nombre" value="<?= htmlspecialchars($datos['Nombre']) ?>" required></label><br>
    <label>Dirección:<br><input type="text" name="direccion" value="<?= htmlspecialchars($datos['Direccion']) ?>" required></label><br>
    <label>Ciudad:<br><input type="text" name="ciudad" value="<?= htmlspecialchars($datos['Ciudad']) ?>" required></label><br>
    <label>País:<br><input type="text" name="pais" value="<?= htmlspecialchars($datos['Pais']) ?>" required></label><br>
    <button type="submit">Guardar cambios</button>
    <a href="listar_supermercado.php">Cancelar</a>
  </form>
</body>
</html>

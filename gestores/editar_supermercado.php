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

  <section class="formulario-producto">
    <h2>Editar Supermercado</h2>
        <h3><strong>ID:</strong> <?= htmlspecialchars($id) ?></h3>
        <h3><strong>Nombre actual:</strong> <?= htmlspecialchars($datos['Nombre']) ?></h3>
    <form method="post" class="form-add-producto" action="">
      
      <label>Nombre:<input type="text" name="nombre" value="<?= htmlspecialchars($datos['Nombre']) ?>" required></label>
      <label>Dirección:<input type="text" name="direccion" value="<?= htmlspecialchars($datos['Direccion']) ?>" required></label>
      <label>Ciudad:<input type="text" name="ciudad" value="<?= htmlspecialchars($datos['Ciudad']) ?>" required></label>
      <label>País:<input type="text" name="pais" value="<?= htmlspecialchars($datos['Pais']) ?>" required></label>

    <div class="botones-crud">
  <input type="submit" class="boton" value="Guardar cambios">
  <a class="boton boton-salir" href="listar_supermercado.php">Cancelar</a>
</div>
  
  </section>
<?php
    include "../includes/pie.html";
    ?>
</body>
   
</html>

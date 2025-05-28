<?php
include_once __DIR__ . '/../config.php';
include_once __DIR__ . '/../modelo/bdd/mysql.php';

$sql = "SELECT ID_Supermercado, Nombre, Direccion, Ciudad, Pais
        FROM supermercado
        ORDER BY ID_Supermercado ASC";
$resultados = yayaBD::consultaLectura($sql);

yayaBD::cerrarConexion();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Supermercados</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>includes/styles.css">
</head>
<body>
  <?php include_once __DIR__ . '/../includes/cabecera.php'; ?>
<main style="flex: 1;">
  <section class="seccion-listado">
      <h1> 🛒 Supermercados registrados</h1>

      <?php if ($resultados && count($resultados) > 0): ?>
        <div class="tabla-wrapper">
        <table class="tabla-productos">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Dirección</th>
              <th>Ciudad</th>
              <th>País</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($resultados as $fila): ?>
              <tr>
                <td><?= htmlspecialchars($fila['ID_Supermercado']) ?></td>
                <td><?= htmlspecialchars($fila['Nombre']) ?></td>
                <td><?= htmlspecialchars($fila['Direccion']) ?></td>
                <td><?= htmlspecialchars($fila['Ciudad']) ?></td>
                <td><?= htmlspecialchars($fila['Pais']) ?></td>
                <td class="acciones">
                  <form action="editar_supermercado.php" method="get" style="display:inline;">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($fila['ID_Supermercado']) ?>">
                    <input type="submit" class="boton boton-modificar" value="Modificar">
                  </form>
                  |
                  <form action="eliminar_supermercado.php" method="post" class="form-eliminar" style="display:inline;" onsubmit="return confirm('¿Seguro que deseas eliminar este supermercado?');">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($fila['ID_Supermercado']) ?>">
                    <button type="submit" class="boton boton-eliminar">Eliminar</button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        </div>
      <?php else: ?>
        <p>No hay supermercados registrados.</p>
      <?php endif; ?>
      <div class="botones-navegacion">
          <a href="<?= BASE_URL ?>/../sesiones/accesoUser.php">← Volver a mi perfil</a>
      </div>
  </section>
</main>
  <?php include_once __DIR__ . '/../includes/pie.html'; ?>
</body>
</html>
<?php
require_once("../database/connection.php");
$db = new Database;
$con = $db->conectar();

// Consulta uniendo las tablas
$sql = "
    SELECT 
        p.documento,
        p.nombre AS proveedor,
        p.email,
        c.fecha_compra,
        pr.codigo,
        pr.nombre AS producto,
        pr.marca,
        ci.cantidad,
        ci.valor_unitario,
        ci.valor_total_item,
        c.valor_total
    FROM compra c
    INNER JOIN proveedor p ON c.id_proveedor = p.id_proveedor
    INNER JOIN compra_item ci ON c.id_compra = ci.id_compra
    INNER JOIN producto pr ON ci.id_producto = pr.id_producto
    ORDER BY c.fecha_compra DESC
";
$compras = $con->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reporte de Compras</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
          <!-- Botón para regresar -->
      <a href="../index.php">
        <button type="button">Regresar</button>
      </a>
  <div class="card shadow-lg border-0 rounded-3">
    <div class="card-header bg-dark text-white text-center">
      <h4><i class="bi bi-bar-chart-line-fill"></i> Reporte de Compras</h4>
    </div>
    <div class="card-body">
      <?php if (isset($_GET['msg']) && $_GET['msg'] === "ok"): ?>
        <div class="alert alert-success"> Compra registrada correctamente</div>
      <?php endif; ?>

      <table class="table table-striped table-hover">
        <thead class="table-dark">
          <tr>
            <th>Documento</th>
            <th>Proveedor</th>
            <th>Email</th>
            <th>Fecha</th>
            <th>Código</th>
            <th>Producto</th>
            <th>Marca</th>
            <th>Cantidad</th>
            <th>V. Unitario</th>
            <th>V. Total Item</th>
            <th>V. Total Compra</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($compras as $row): ?>
            <tr>
              <td><?= $row['documento'] ?></td>
              <td><?= $row['proveedor'] ?></td>
              <td><?= $row['email'] ?></td>
              <td><?= $row['fecha_compra'] ?></td>
              <td><?= $row['codigo'] ?></td>
              <td><?= $row['producto'] ?></td>
              <td><?= $row['marca'] ?></td>
              <td><?= $row['cantidad'] ?></td>
              <td>$<?= number_format($row['valor_unitario'], 2) ?></td>
              <td>$<?= number_format($row['valor_total_item'], 2) ?></td>
              <td>$<?= number_format($row['valor_total'], 2) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</body>
</html>

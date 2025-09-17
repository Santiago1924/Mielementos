<?php
require_once("../database/connection.php");
$db = new Database;
$con = $db->conectar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro de Compras</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container mt-5">
  <h2 class="text-center mb-4">Registro de Compras</h2>
  <form action="save_compra.php" method="POST" class="card p-4 shadow">
    
    <!-- Datos proveedor -->
    <div class="row mb-3">
      <div class="col-md-4">
        <label class="form-label">Documento</label>
        <input type="text" name="documento" class="form-control" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>
    </div>

    <!-- Fecha compra -->
    <div class="row mb-3">
      <div class="col-md-4">
        <label class="form-label">Fecha Compra</label>
        <input type="date" name="fecha_compra" class="form-control" required>
      </div>
    </div>

    <!-- Productos -->
    <div id="productos">
      <div class="row mb-3 producto">
        <div class="col-md-3">
          <label class="form-label">Código</label>
          <input type="text" name="codigo[]" class="form-control" required>
        </div>
        <div class="col-md-3">
          <label class="form-label">Nombre Producto</label>
          <input type="text" name="nombre_producto[]" class="form-control" required>
        </div>
        <div class="col-md-2">
          <label class="form-label">Marca</label>
          <input type="text" name="marca[]" class="form-control" required>
        </div>
        <div class="col-md-2">
          <label class="form-label">Cantidad</label>
          <input type="number" name="cantidad[]" class="form-control" required>
        </div>
        <div class="col-md-2">
          <label class="form-label">Valor Unitario</label>
          <input type="number" step="0.01" name="valor_unitario[]" class="form-control" required>
        </div>
      </div>
    </div>

    <button type="button" class="btn btn-secondary mb-3" id="agregarProducto">+ Agregar Producto</button>
    <button type="submit" class="btn btn-primary w-100">Guardar Compra</button>
  </form>
</div>

<script>
  document.getElementById("agregarProducto").addEventListener("click", function() {
    let div = document.querySelector(".producto").cloneNode(true);
    div.querySelectorAll("input").forEach(input => input.value = "");
    document.getElementById("productos").appendChild(div);
  });
</script>
</body>
</html>

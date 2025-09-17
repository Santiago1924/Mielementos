<?php
require_once("../database/connection.php");
$db = new Database();
$con = $db->conectar();

// Consultar proveedores
$sqlProveedores = $con->query("SELECT id_proveedor, nombre FROM proveedor");
$proveedores = $sqlProveedores->fetchAll(PDO::FETCH_ASSOC);

// Consultar productos
$sqlProductos = $con->query("SELECT id_producto, nombre FROM producto");
$productos = $sqlProductos->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Formulario de Compras</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
  <script>
    function validarFormulario() {
      let proveedor = document.forms["compraForm"]["id_proveedor"].value;
      let producto = document.forms["compraForm"]["id_producto"].value;
      let cantidad = document.forms["compraForm"]["cantidad"].value;
      let precio = document.forms["compraForm"]["precio"].value;

    //   campos vacios

      if (proveedor === "" || producto === "" || cantidad === "" || precio === "") {
        alert(" Todos los campos son obligatorios");
        return false;
      }
      if (isNaN(cantidad) || cantidad <= 0) {
        alert(" La cantidad debe ser un número positivo");
        return false;
      }
      if (isNaN(precio) || precio <= 0) {
        alert(" El precio debe ser un número positivo");
        return false;
      }
      return true;
    }
  </script>
</head>
<body>
  <div class="container">
    <h2><i class="bi bi-cart4"></i> <div>Registrar compra</div></h2>
    <form name="compraForm" action="save_compra.php" method="POST" onsubmit="return validarFormulario()">

      <label>Proveedor:</label>
      <select name="id_proveedor" required>
        <option value="">Seleccione un proveedor</option>
        <?php foreach ($proveedores as $prov): ?>
          <option value="<?= $prov['id_proveedor'] ?>"><?= $prov['nombre'] ?></option>
        <?php endforeach; ?>
      </select>

      <label>Fecha de Compra:</label>
      <input type="date" name="fecha_compra" required>

      <label>Referencia:</label>
      <input type="text" name="referencia" placeholder="Ejemplo: Factura 123">

      <hr>

      <label>Producto:</label>
      <select name="productos[0][id_producto]" required>
        <option value="">Seleccione un producto</option>
        <?php foreach ($productos as $prod): ?>
          <option value="<?= $prod['id_producto'] ?>"><?= $prod['nombre'] ?></option>
        <?php endforeach; ?>
      </select>

      <label>Cantidad:</label>
      <input type="number" name="productos[0][cantidad]" placeholder="Ejemplo: 5" required>

      <label>Precio Unitario:</label>
      <input type="number" step="0.01" name="productos[0][precio]" placeholder="Ejemplo: 250.50" required>

      <button type="submit"> Guardar Compra</button>
      <!-- Botón para regresar -->
      <a href="../index.php">
        <button type="button">Regresar</button>
      </a>
    </form>
  </div>
</body>
</html>

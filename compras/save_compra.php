<?php
require_once("../database/connection.php");

$db = new Database();
$con = $db->conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Validar datos obligatorios
        if (empty($_POST['id_proveedor']) || empty($_POST['fecha_compra']) || empty($_POST['productos'])) {
            throw new Exception(" Todos los campos son obligatorios.");
        }

        $id_proveedor = $_POST['id_proveedor'];
        $fecha_compra = $_POST['fecha_compra'];
        $referencia   = !empty($_POST['referencia']) ? $_POST['referencia'] : null;
        $productos    = $_POST['productos'];

        // Iniciar transacción
        $con->beginTransaction();

        // Calcular el valor total de la compra
        $valor_total = 0;
        foreach ($productos as $prod) {
            $valor_total += $prod['cantidad'] * $prod['precio'];
        }

        // Insertar cabecera en COMPRA
        $sql = $con->prepare("INSERT INTO compra (id_proveedor, fecha_compra, valor_total, referencia) 
                              VALUES (:id_proveedor, :fecha_compra, :valor_total, :referencia)");
        $sql->bindParam(':id_proveedor', $id_proveedor);
        $sql->bindParam(':fecha_compra', $fecha_compra);
        $sql->bindParam(':valor_total', $valor_total);
        $sql->bindParam(':referencia', $referencia);

        $sql->execute();
        $id_compra = $con->lastInsertId();

        // Insertar productos 
        $sqlItem = $con->prepare("INSERT INTO compra_item 
                                  (id_compra, id_producto, cantidad, valor_unitario, valor_total_item) 
                                  VALUES (:id_compra, :id_producto, :cantidad, :valor_unitario, :valor_total_item)");

        foreach ($productos as $prod) {
            $id_producto = $prod['id_producto'];
            $cantidad = $prod['cantidad'];
            $valor_unitario = $prod['precio'];
            $valor_total_item = $cantidad * $valor_unitario;

            $sqlItem->bindParam(':id_compra', $id_compra);
            $sqlItem->bindParam(':id_producto', $id_producto);
            $sqlItem->bindParam(':cantidad', $cantidad);
            $sqlItem->bindParam(':valor_unitario', $valor_unitario);
            $sqlItem->bindParam(':valor_total_item', $valor_total_item);
            $sqlItem->execute();
        }

        // Confirmar transacción
        $con->commit();

        echo " Compra registrada correctamente.";
        echo "<br><a href='form_compra.php'>Volver al formulario</a>";

    } catch (Exception $e) {
        // Revertir si ocurre error
        $con->rollBack();
        echo " Error al registrar la compra: " . $e->getMessage();
    }
}
?>


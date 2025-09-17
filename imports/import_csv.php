<?php
require_once("../database/connection.php");
$db = new Database;
$con = $db->conectar();

if (isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] == 0) {
    $file = fopen($_FILES['csv_file']['tmp_name'], "r");

    // Omitir la primera fila (cabecera)
    fgetcsv($file, 1000, ",");

    while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
        // Ajusta columnas según el CSV real
        $documento   = $data[0];
        $nombre      = $data[1];
        $email       = $data[2];
        $telefono    = $data[3];
        $direccion   = $data[4];
        $codigo      = $data[5];
        $producto    = $data[6];
        $marca       = $data[7];
        $unidad      = $data[8];
        $fecha       = $data[9];
        $cantidad    = $data[10];
        $valor_unit  = $data[11];

        // Insertar proveedor si no existe
        $stmt = $con->prepare("SELECT id_proveedor FROM proveedor WHERE documento = ?");
        $stmt->execute([$documento]);
        $prov = $stmt->fetch();

        if (!$prov) {
            $stmt = $con->prepare("INSERT INTO proveedor (documento, nombre, email, telefono, direccion) VALUES (?,?,?,?,?)");
            $stmt->execute([$documento, $nombre, $email, $telefono, $direccion]);
            $id_proveedor = $con->lastInsertId();
        } else {
            $id_proveedor = $prov['id_proveedor'];
        }

        // Insertar producto si no existe
        $stmt = $con->prepare("SELECT id_producto FROM producto WHERE codigo = ?");
        $stmt->execute([$codigo]);
        $prod = $stmt->fetch();

        if (!$prod) {
            $stmt = $con->prepare("INSERT INTO producto (codigo, nombre, marca, unidad_medida) VALUES (?,?,?,?)");
            $stmt->execute([$codigo, $producto, $marca, $unidad]);
            $id_producto = $con->lastInsertId();
        } else {
            $id_producto = $prod['id_producto'];
        }

        // Insertar compra
        $stmt = $con->prepare("INSERT INTO compra (id_proveedor, fecha_compra, valor_total) VALUES (?,?,0)");
        $stmt->execute([$id_proveedor, $fecha]);
        $id_compra = $con->lastInsertId();

        // Insertar items de compra
        $valor_total_item = $cantidad * $valor_unit;
        $stmt = $con->prepare("INSERT INTO compra_item (id_compra, id_producto, cantidad, valor_unitario, valor_total_item) VALUES (?,?,?,?,?)");
        $stmt->execute([$id_compra, $id_producto, $cantidad, $valor_unit, $valor_total_item]);

        // Actualizar valor_total en compra
        $stmt = $con->prepare("UPDATE compra SET valor_total = valor_total + ? WHERE id_compra = ?");
        $stmt->execute([$valor_total_item, $id_compra]);
    }

    fclose($file);
    echo " Importación completada con éxito.";
} else {
    echo " Error al subir el archivo.";
}

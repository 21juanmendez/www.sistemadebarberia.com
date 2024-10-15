<?php

include('../../config.php');
$id_venta = $_GET['id_venta'];
$id_venta_producto = $_GET['id_venta_producto'];
$id_producto = $_GET['id_producto'];

$sql = "SELECT cantidad FROM tb_ventas_producto WHERE id_venta_producto = $id_venta_producto";
$query = $pdo->prepare($sql);
$query->execute();
$cantidad_producto = $query->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT stock FROM tb_productos WHERE id_producto = $id_producto";
$query = $pdo->prepare($sql);
$query->execute();
$stock_producto = $query->fetch(PDO::FETCH_ASSOC);

$devolver_stock = $stock_producto['stock'] + $cantidad_producto['cantidad'];

$sql = "UPDATE tb_productos SET stock = $devolver_stock WHERE id_producto = $id_producto";
$query = $pdo->prepare($sql);
$query->execute();

$sql = "DELETE FROM tb_ventas_producto WHERE id_venta_producto = $id_venta_producto";
$query = $pdo->prepare($sql);
$query->execute();


header("Location:" . $VIEWS . "/ventas/create.php?id_venta=" . $id_venta);

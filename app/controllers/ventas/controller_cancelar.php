<?php

include('../../config.php');
$id_venta = $_GET['id_venta'];

$sql = "SELECT * FROM tb_ventas_producto WHERE id_venta = $id_venta";
$query = $pdo->prepare($sql);
$query->execute();
$ventas_productos = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($ventas_productos as $venta_producto) {
    $id_venta_producto = $venta_producto['id_venta_producto'];
    $id_producto = $venta_producto['id_producto'];
    $cantidad = $venta_producto['cantidad'];

    $sql = "SELECT stock FROM tb_productos WHERE id_producto = $id_producto";
    $query = $pdo->prepare($sql);
    $query->execute();
    $stock_producto = $query->fetch(PDO::FETCH_ASSOC);

    $devolver_stock = $stock_producto['stock'] + $cantidad;

    $sql = "UPDATE tb_productos SET stock = $devolver_stock WHERE id_producto = $id_producto";
    $query = $pdo->prepare($sql);
    $query->execute();
}

$sql = "DELETE FROM tb_ventas WHERE id_venta = $id_venta";
$query = $pdo->prepare($sql);
if ($query->execute()) {
    session_start();
    $_SESSION["mensaje"] = "Venta cancelada";
    $_SESSION["icono"] = "error";
    header("Location:" . $VIEWS . "/ventas");
}

<?php
include('../../config.php');
$id_venta = $_POST['id_venta'];
session_start(); // Iniciar la sesión para mensajes

// guardamos el id del usuario que elimina la venta
$id_usuario = $_SESSION["id_usuario"];
$fyh_eliminacion = date('Y-m-d H:i:s'); // fecha y hora de eliminación
$sql = "SELECT * FROM tb_ventas WHERE id_venta = $id_venta";
$query = $pdo->prepare($sql);
$query->execute();
$venta = $query->fetch(PDO::FETCH_ASSOC);

// Guardar la venta eliminada
$sql = "INSERT INTO tb_venta_eliminada (id_venta_eliminada, id_vendedor, total_venta, fyh_creacion, subtotal_productos, subtotal_servicios, total_pagado, cambio, completa, id_usuario, fyh_eliminacion) VALUES (:id_venta_eliminada, :id_vendedor, :total_venta, :fyh_creacion, :subtotal_productos, :subtotal_servicios, :total_pagado, :cambio, :completa, :id_usuario, :fyh_eliminacion)";
$query = $pdo->prepare($sql);
$query->execute([
    'id_venta_eliminada' => $venta['id_venta'],
    'id_vendedor' => $venta['id_usuario'],
    'total_venta' => $venta['total_venta'],
    'fyh_creacion' => $venta['fyh_creacion'],
    'subtotal_productos' => $venta['subtotal_productos'],
    'subtotal_servicios' => $venta['subtotal_servicios'],
    'total_pagado' => $venta['total_pagado'],
    'cambio' => $venta['cambio'],
    'completa' => $venta['completa'],
    'id_usuario' => $id_usuario,
    'fyh_eliminacion' => $fyh_eliminacion
]);

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
    $_SESSION['mensaje'] = 'Venta eliminada correctamente';
    $_SESSION['icono'] = 'success';
    header('Location:' . $VIEWS . '/ventas');
}
<?php

include('../../config.php');

$id_venta = $_POST['id_venta'];
$subtotal_producto = $_POST['subtotal_productos'];
$subtotal_servicio = $_POST['subtotal_servicios'];
$total_venta = $_POST['total_a_pagar'];
$total_pagado = $_POST['total_pagado'];
$cambio = $_POST['cambio'];
$completa = 1;
$sql = "UPDATE tb_ventas SET subtotal_productos = :subtotal_producto, subtotal_servicios = :subtotal_servicio, total_venta = :total_venta, total_pagado = :total_pagado, cambio = :cambio, completa = :completa WHERE id_venta = :id_venta";
$params = array(
    ':subtotal_producto' => $subtotal_producto,
    ':subtotal_servicio' => $subtotal_servicio,
    ':total_venta' => $total_venta,
    ':total_pagado' => $total_pagado,
    ':cambio' => $cambio,
    ':completa' => $completa,
    ':id_venta' => $id_venta
);
// Preparar la consulta
$query = $pdo->prepare($sql);
// Ejecutar la consulta
if ($query->execute($params)) {
    session_start();
    $_SESSION["mensaje"] = "Venta registrada correctamente";
    $_SESSION["icono"] = "success";
    header("Location:" . $VIEWS . "/ventas");
}

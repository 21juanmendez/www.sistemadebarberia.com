<?php

include('../../config.php');

$id_venta = $_POST['id_venta'];
$id_cliente = $_POST['id_cliente'];
$puntos_acumulados = $_POST['puntos_acumulados'];
$subtotal_producto = $_POST['subtotal_productos'];
$subtotal_servicio = $_POST['subtotal_servicios'];
$total_venta = $_POST['total_a_pagar'];
$total_pagado = $_POST['total_pagado'];
$cambio = $_POST['cambio'];
$completa = 1;
$fyh_visita = date('Y-m-d H:i:s');

if ($id_cliente == 0) {
    $id_cliente = null; // Si no hay cliente, se establece como NULL
} else {
    $sql = "UPDATE tb_clientes SET acumulado_puntos = acumulado_puntos + :puntos_acumulados, fecha_ultima_visita = :fecha_ultima_visita WHERE id_cliente = :id_cliente";
    $params = array(
        ':puntos_acumulados' => $puntos_acumulados,
        ':fecha_ultima_visita' => $fyh_visita,
        ':id_cliente' => $id_cliente
    );
    $query = $pdo->prepare($sql);
    $query->execute($params);
}

$sql = "UPDATE tb_ventas SET id_cliente = :id_cliente, subtotal_productos = :subtotal_producto,
 subtotal_servicios = :subtotal_servicio, total_venta = :total_venta,
  total_pagado = :total_pagado, cambio = :cambio, completa = :completa
   WHERE id_venta = :id_venta";
$params = array(
    ':id_cliente' => $id_cliente,
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

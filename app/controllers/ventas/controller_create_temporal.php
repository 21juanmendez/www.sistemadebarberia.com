<?php
include("../../config.php");

session_start(); // Iniciar la sesión para mensajes

// Datos que se reciben del formulario
$id_usuario = $_SESSION["id_usuario"];
$total_venta = 0; // Inicialmente 0, se actualizará cuando se añadan productos/servicios
$fyh_creacion = date("Y-m-d H:i:s"); // Fecha y hora de creación

$sql = "INSERT INTO tb_ventas (id_usuario, total_venta, fyh_creacion, subtotal_productos, subtotal_servicios, total_pagado, cambio) 
VALUES (:id_usuario, :total_venta, :fyh_creacion, :subtotal_productos, :subtotal_servicios, :total_pagado, :cambio);";
$query = $pdo->prepare($sql);

// Asignar los parámetros a la consulta
$params = array(
    ':id_usuario' => $id_usuario,
    ':total_venta' => $total_venta,
    ':fyh_creacion' => $fyh_creacion,
    ':subtotal_productos' => 0,
    ':subtotal_servicios' => 0,
    ':total_pagado' => 0,
    ':cambio' => 0
);

// Ejecutar la consulta
if ($query->execute($params)) {
    // Obtener el ID de la venta recién creada
    $id_venta = $pdo->lastInsertId();
    header("Location:" . $VIEWS . "/ventas/create.php?id_venta=" . $id_venta);
    exit;
} else {
    // Si ocurre un error en la inserción
    $_SESSION["mensaje"] = "Error al crear la venta temporal.";
    $_SESSION["icono"] = "error";
    header("Location:" . $VIEWS . "/ventas/index.php");
    exit;
}



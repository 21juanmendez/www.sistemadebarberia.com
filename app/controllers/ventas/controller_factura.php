<?php
$id_venta = $_GET['id_venta'];
$sql = "SELECT p.nombre_producto, p.descripcion, p.precio_venta, vp.cantidad, vp.precio 
FROM tb_productos p
INNER JOIN tb_ventas_producto vp ON p.id_producto = vp.id_producto
WHERE vp.id_venta = $id_venta";
$query = $pdo->prepare($sql);
$query->execute();
$productos_vendidos = $query->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT s.nombre_servicio, s.descripcion, s.precio as precio_venta, vs.cantidad, vs.precio 
FROM tb_servicios s
INNER JOIN tb_ventas_servicio vs ON s.id_servicio = vs.id_servicio
WHERE vs.id_venta = $id_venta";
$query = $pdo->prepare($sql);
$query->execute();
$servicios_vendidos = $query->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT v.*, u.nombre_completo FROM tb_usuarios u
INNER JOIN tb_ventas v ON u.id_usuario = v.id_usuario
WHERE v.id_venta = $id_venta";
$query = $pdo->prepare($sql);
$query->execute();
$venta = $query->fetch(PDO::FETCH_ASSOC);
$nombre_vendedor = $venta['nombre_completo'];
$fecha_venta = $venta['fyh_creacion'];
$total_venta = $venta['total_venta'];
$subtotal_productos = $venta['subtotal_productos'];
$subtotal_servicios = $venta['subtotal_servicios'];
$total_pago = $venta['total_pagado'];
$cambio = $venta['cambio'];
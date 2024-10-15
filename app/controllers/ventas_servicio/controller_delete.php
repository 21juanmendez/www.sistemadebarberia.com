<?php

include('../../config.php');
$id_venta = $_GET['id_venta'];
$id_venta_servicio = $_GET['id_venta_servicio'];

$sql = "DELETE FROM tb_ventas_servicio WHERE id_venta_servicio = $id_venta_servicio";
$query = $pdo->prepare($sql);
if ($query->execute()) {
    header("Location:" . $VIEWS . "/ventas/create.php?id_venta=" . $id_venta);
}

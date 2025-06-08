<?php

include('../../config.php');

$id_gasto = $_POST['id_gasto'];
$id_categoria_gasto = $_POST['id_categoria_gasto'];
$descripcion = $_POST['descripcion'];
$monto = $_POST['monto'];
$fecha_gasto = $_POST['fecha_gasto'];

$fyh_actualizacion = date('Y-m-d H:i:s');

$sql = "UPDATE tb_gastos SET 
        id_categoria_gasto='$id_categoria_gasto', 
        descripcion='$descripcion',
        monto='$monto', 
        fecha_gasto='$fecha_gasto', 
        fyh_actualizacion='$fyh_actualizacion'
        WHERE id_gasto='$id_gasto'";

$query = $pdo->prepare($sql);
$query->execute();

session_start();
$_SESSION['mensaje'] = "Gasto actualizado correctamente";
$_SESSION['icono'] = "success";
header("Location:" . $VIEWS . '/gastos');

?>
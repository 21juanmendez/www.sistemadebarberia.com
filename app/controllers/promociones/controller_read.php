<?php

$id = $_GET['id'];

$sql = "SELECT * FROM tb_promociones WHERE id = '$id'";
$query = $pdo->prepare($sql);
$query->execute();
$promocion = $query->fetch(PDO::FETCH_ASSOC);

$id_promocion = $promocion['id'];
$nombre = $promocion['nombre'];
$descripcion = $promocion['descripcion'];
$imagen = $promocion['imagen'];
$puntos_requeridos = $promocion['puntos_requeridos'];
$activo = $promocion['activo'];
$promo_valida = $promocion['promo_valida'];
$created_at = $promocion['created_at'];
$updated_at = $promocion['updated_at'];

?>
<?php

$id_servicio = $_GET['id_servicio'];
$sql = "SELECT * FROM tb_servicios WHERE id_servicio = $id_servicio";
$query = $pdo->prepare($sql);
$query->execute();
$servicios = $query->fetchAll(PDO::FETCH_ASSOC);

foreach($servicios as $servicio){
    $nombre_servicio = $servicio['nombre_servicio'];
    $precio = $servicio['precio'];
    $descripcion = $servicio['descripcion'];
    $imagen = $servicio['imagen'];
    $fyh_creacion = $servicio['fyh_creacion'];
    $fyh_actualizacion = $servicio['fyh_actualizacion'];
}
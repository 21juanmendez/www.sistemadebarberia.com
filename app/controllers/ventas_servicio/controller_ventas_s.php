<?php

//Aqui mostramos los productos que se han vendido
$sql = "SELECT vs.*, s.nombre_servicio FROM tb_ventas_servicio vs
INNER JOIN tb_servicios s ON vs.id_servicio = s.id_servicio
INNER JOIN tb_ventas v ON vs.id_venta = v.id_venta";



$query = $pdo->prepare($sql);
$query->execute();
$servicios_vendidos = $query->fetchAll(PDO::FETCH_ASSOC);

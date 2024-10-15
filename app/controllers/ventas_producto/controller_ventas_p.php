<?php

//Aqui mostramos los productos que se han vendido
$sql = "SELECT vp.*, p.nombre_producto FROM tb_ventas_producto vp 
INNER JOIN tb_productos p ON vp.id_producto = p.id_producto
INNER JOIN tb_ventas v ON vp.id_venta = v.id_venta";



$query = $pdo->prepare($sql);
$query->execute();
$productos_vendidos = $query->fetchAll(PDO::FETCH_ASSOC);

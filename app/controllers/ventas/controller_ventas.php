<?php
//Traemos todos los datos de la tabla y muestra el total de empleados
$sql = "SELECT v.id_venta, v.id_usuario as usuario_venta, u.nombre_completo, v.subtotal_productos, v.subtotal_servicios, v.total_venta, v.fyh_creacion FROM tb_ventas v
        INNER JOIN tb_usuarios u ON v.id_usuario = u.id_usuario";

$query = $pdo->query($sql);
$query->execute();
$ventas = $query->fetchAll(PDO::FETCH_ASSOC);

$contadorVentas = 0;
foreach( $ventas as $venta ){
    $contadorVentas++;
}

<?php

//Traemos todos los datos de la tabla y muestra el total de empleados
$sql = "SELECT ve.*, u.nombre_completo, uv.nombre_completo as vendedor FROM tb_venta_eliminada ve
        INNER JOIN tb_usuarios u ON ve.id_usuario = u.id_usuario
        INNER JOIN tb_usuarios uv ON ve.id_vendedor = uv.id_usuario";

$query = $pdo->query($sql);
$query->execute();
$ventas_eliminadas = $query->fetchAll(PDO::FETCH_ASSOC);
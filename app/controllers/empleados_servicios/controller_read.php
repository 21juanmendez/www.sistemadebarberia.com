<?php
$id_empleado = $_GET['id_empleado'];
// aqui mostramos el nombre del servicio que tiene asignado el empleado en la tabla de agregar servicios
$sql = "SELECT es.*, s.nombre_servicio
        FROM tb_empleado_servicio es
        INNER JOIN tb_servicios s ON es.id_servicio = s.id_servicio 
        AND es.id_empleado = $id_empleado";
$query = $pdo->query($sql);
$query->execute();
$empleados_servicios = $query->fetchAll();




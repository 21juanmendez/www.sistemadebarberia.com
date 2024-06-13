<?php

//Aqui mostramos los empleados con sus servicios en la tabla principal
$sql = "SELECT e.*, GROUP_CONCAT(s.nombre_servicio SEPARATOR ', ') AS servicios
FROM tb_empleados e 
LEFT JOIN tb_empleado_servicio es ON e.id_empleado = es.id_empleado 
LEFT JOIN tb_servicios s ON es.id_servicio = s.id_servicio
GROUP BY e.id_empleado
ORDER BY e.id_empleado DESC;
";

$query = $pdo->query($sql);
$query->execute();
$empleados = $query->fetchAll(PDO::FETCH_ASSOC);

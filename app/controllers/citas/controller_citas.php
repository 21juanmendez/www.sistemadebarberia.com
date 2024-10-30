<?php
$sql = "SELECT c.id_usuario, c.id_cita, u.nombre_completo, u.telefono, u.id_rol, r.nombre, u.email, s.nombre_servicio, c.fecha_cita, c.hora_cita 
        FROM tb_cita c 
        INNER JOIN tb_usuarios u ON c.id_usuario = u.id_usuario 
        INNER JOIN tb_roles r ON u.id_rol = r.id_rol
        INNER JOIN tb_servicios s ON c.id_servicio = s.id_servicio
        ORDER BY CASE 
                     WHEN c.fecha_cita >= CURDATE() THEN 0
                     ELSE 1
                 END, 
                 c.fecha_cita ASC, 
                 c.hora_cita ASC"; // Priorizar citas futuras y luego ordenar por fecha y hora

$query = $pdo->prepare($sql);
$query->execute();
$citas = $query->fetchAll();

$contadorCitas = $query->rowCount();

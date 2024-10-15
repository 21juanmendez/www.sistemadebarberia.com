<?php


$sql = "SELECT c.id_usuario, c.id_cita, u.nombre_completo, u.telefono, u.id_rol, r.nombre, u.email, s.nombre_servicio, c.fecha_cita, c.hora_cita 
        FROM tb_cita c 
        INNER JOIN tb_usuarios u ON c.id_usuario = u.id_usuario 
        INNER JOIN tb_roles r ON u.id_rol = r.id_rol
        INNER JOIN tb_servicios s ON c.id_servicio = s.id_servicio";
$query = $pdo->prepare($sql);
$query->execute();
$citas = $query->fetchAll();


?>
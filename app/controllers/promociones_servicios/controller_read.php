<?php
// app/controllers/promociones_servicios/controller_read.php

// Obtener los servicios asociados a la promoción
$sql = "SELECT ps.id_promocion, ps.id_servicio, s.nombre_servicio, s.precio 
        FROM tb_promociones_servicios ps 
        INNER JOIN tb_servicios s ON ps.id_servicio = s.id_servicio 
        WHERE ps.id_promocion = :id_promocion
        ORDER BY s.nombre_servicio ASC";

$query = $pdo->prepare($sql);
$query->bindParam(':id_promocion', $id_promocion);
$query->execute();
$promociones_servicios = $query->fetchAll(PDO::FETCH_ASSOC);

?>
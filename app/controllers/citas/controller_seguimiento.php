<?php

$id_usuario = $_SESSION['id']; // Obtén el ID del usuario desde la sesión

try {
    // Consulta para obtener las citas pendientes ordenadas de las más cercanas a las más lejanas
    $sql = "SELECT c.id_cita, s.nombre_servicio, c.fecha_cita, c.hora_cita 
            FROM tb_cita c 
            INNER JOIN tb_servicios s ON c.id_servicio = s.id_servicio
            WHERE c.id_usuario = :id_usuario 
              AND (c.fecha_cita > CURDATE() 
                   OR (c.fecha_cita = CURDATE() AND c.hora_cita >= CURTIME()))
            ORDER BY c.fecha_cita ASC, c.hora_cita ASC";
    
    $query = $pdo->prepare($sql);
    $query->bindParam(':id_usuario', $id_usuario);
    $query->execute();
    $citas = $query->fetchAll();

} catch (Exception $e) {
    $_SESSION['mensaje'] = "Error al obtener citas: " . $e->getMessage();
    $citas = []; // En caso de error, inicializamos citas como un array vacío
}

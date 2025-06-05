<?php

// Consulta actualizada que verifica si cada promoción tiene servicios
$sql = "SELECT p.*, 
        CASE 
            WHEN EXISTS (SELECT 1 FROM tb_promociones_servicios ps WHERE ps.id_promocion = p.id) 
            THEN true 
            ELSE false 
        END as promo_valida
        FROM tb_promociones p 
        ORDER BY p.puntos_requeridos ASC";

$query = $pdo->prepare($sql);
$query->execute();
$promociones = $query->fetchAll(PDO::FETCH_ASSOC);

// Actualizar el campo promo_valida en la base de datos basado en si tiene servicios
foreach ($promociones as $promocion) {
    $updateSql = "UPDATE tb_promociones SET promo_valida = ? WHERE id = ?";
    $updateQuery = $pdo->prepare($updateSql);
    $updateQuery->execute([$promocion['promo_valida'], $promocion['id']]);
}

$contadorPromociones = 0;
foreach ($promociones as $promocion) {
    $contadorPromociones++;
}

?>
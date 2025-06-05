<?php
$sql = "SELECT * FROM tb_promociones WHERE promo_valida = true
 ORDER BY puntos_requeridos DESC";
$query = $pdo->prepare($sql);
$query->execute();
$promociones = $query->fetchAll(PDO::FETCH_ASSOC);

//Agregar servicios a cada promoción
foreach ($promociones as &$promocion) {
    $sqlServicios = "SELECT s.nombre_servicio
                     FROM tb_promociones_servicios ps 
                     INNER JOIN tb_servicios s ON ps.id_servicio = s.id_servicio 
                     WHERE ps.id_promocion = :id_promocion";
    $queryServicios = $pdo->prepare($sqlServicios);
    $queryServicios->execute(['id_promocion' => $promocion['id']]);
    $promocion['servicios'] = $queryServicios->fetchAll(PDO::FETCH_ASSOC);
}

//Nombres de servicios con cantidad de puntos que acumulan
$sqlServiciosPuntos = "SELECT nombre_servicio, acumula_puntos
                        FROM tb_servicios";
$queryServiciosPuntos = $pdo->prepare($sqlServiciosPuntos);
$queryServiciosPuntos->execute();
$serviciosPuntos = $queryServiciosPuntos->fetchAll(PDO::FETCH_ASSOC);


$contadorPromociones = count($promociones);

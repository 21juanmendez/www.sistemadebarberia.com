<?php

$desde = $_GET['desde'] ?? null;
$hasta = $_GET['hasta'] ?? null;

$parametros = [];
$filtroFecha = "";

// Filtro para alias "c" (comentarios con JOINs)
$filtroFechaC = "";
if ($desde && $hasta) {
    $filtroFecha = " WHERE fecha BETWEEN :desde AND :hasta ";
    $filtroFechaC = " WHERE c.fecha BETWEEN :desde AND :hasta ";
    $parametros[':desde'] = $desde;
    $parametros[':hasta'] = $hasta;
}

// Comentarios detallados
$sql = "SELECT 
            c.titulo, 
            c.comentario, 
            c.calificacion, 
            c.fecha, 
            u.nombre_completo, 
            s.nombre_servicio 
        FROM tb_comentarios c
        INNER JOIN tb_usuarios u ON c.id_usuario = u.id_usuario
        INNER JOIN tb_servicios s ON c.id_servicio = s.id_servicio
        $filtroFechaC
        ORDER BY c.calificacion DESC";
$query = $pdo->prepare($sql);
$query->execute($parametros);
$comentarios = $query->fetchAll(PDO::FETCH_ASSOC);

// Total comentarios
$totalComentarios = count($comentarios);

// Promedio de calificación
$promedioCalificacion = 0;
if ($totalComentarios > 0) {
    $suma = array_sum(array_column($comentarios, 'calificacion'));
    $promedioCalificacion = round($suma / $totalComentarios, 1);
}

// Servicio más comentado
$sqlPopular = "SELECT s.nombre_servicio, COUNT(*) as total 
               FROM tb_comentarios c
               INNER JOIN tb_servicios s ON c.id_servicio = s.id_servicio
               $filtroFechaC
               GROUP BY c.id_servicio
               ORDER BY total DESC
               LIMIT 1";
$queryPopular = $pdo->prepare($sqlPopular);
$queryPopular->execute($parametros);
$servicioPopular = $queryPopular->fetch(PDO::FETCH_ASSOC)['nombre_servicio'] ?? 'N/A';

// Último comentario
$fechaUltimo = $comentarios[0]['fecha'] ?? 'Sin registros';

// Gráfico: distribución de calificaciones
$sqlCalificaciones = "SELECT calificacion, COUNT(*) as total 
                      FROM tb_comentarios 
                      $filtroFecha
                      GROUP BY calificacion 
                      ORDER BY calificacion";
$queryCal = $pdo->prepare($sqlCalificaciones);
$queryCal->execute($parametros);
$calificacionesDistribucion = $queryCal->fetchAll(PDO::FETCH_ASSOC);

// Comentarios por servicio
$sqlServicios = "SELECT s.nombre_servicio, COUNT(*) as total 
                 FROM tb_comentarios c
                 INNER JOIN tb_servicios s ON c.id_servicio = s.id_servicio
                 $filtroFechaC
                 GROUP BY s.nombre_servicio
                 ORDER BY total DESC";
$queryServ = $pdo->prepare($sqlServicios);
$queryServ->execute($parametros);
$comentariosPorServicio = $queryServ->fetchAll(PDO::FETCH_ASSOC);

// Comentarios por mes
$sqlMensual = "SELECT DATE_FORMAT(fecha, '%Y-%m') as mes, COUNT(*) as total 
               FROM tb_comentarios 
               $filtroFecha
               GROUP BY mes
               ORDER BY mes";
$queryMes = $pdo->prepare($sqlMensual);
$queryMes->execute($parametros);
$comentariosPorMes = $queryMes->fetchAll(PDO::FETCH_ASSOC);

// Promedios por servicio
$sqlPromedios = "SELECT s.nombre_servicio, ROUND(AVG(c.calificacion),1) as promedio 
                 FROM tb_comentarios c
                 INNER JOIN tb_servicios s ON c.id_servicio = s.id_servicio
                 $filtroFechaC
                 GROUP BY s.nombre_servicio
                 ORDER BY promedio DESC";
$queryProm = $pdo->prepare($sqlPromedios);
$queryProm->execute($parametros);
$promediosPorServicio = $queryProm->fetchAll(PDO::FETCH_ASSOC);

// Top 3 servicios mejor calificados
$sqlTop3 = "SELECT s.nombre_servicio, ROUND(AVG(c.calificacion),1) as promedio, COUNT(*) as total
            FROM tb_comentarios c
            INNER JOIN tb_servicios s ON c.id_servicio = s.id_servicio
            $filtroFechaC
            GROUP BY s.id_servicio
            HAVING total >= 3
            ORDER BY promedio DESC
            LIMIT 3";
$queryTop3 = $pdo->prepare($sqlTop3);
$queryTop3->execute($parametros);
$top3Servicios = $queryTop3->fetchAll(PDO::FETCH_ASSOC);

// Comentarios negativos destacados
$sqlNegativos = "SELECT c.*, u.nombre_completo, s.nombre_servicio
                 FROM tb_comentarios c
                 INNER JOIN tb_usuarios u ON c.id_usuario = u.id_usuario
                 INNER JOIN tb_servicios s ON c.id_servicio = s.id_servicio
                 WHERE c.calificacion <= 2";
if ($desde && $hasta) {
    $sqlNegativos .= " AND c.fecha BETWEEN :desde AND :hasta";
}
$sqlNegativos .= " ORDER BY c.fecha DESC LIMIT 8";
$queryNeg = $pdo->prepare($sqlNegativos);
$queryNeg->execute($parametros);
$comentariosNegativos = $queryNeg->fetchAll(PDO::FETCH_ASSOC);

// Comparativa mes actual vs anterior
$mesActual = date('Y-m');
$mesAnterior = date('Y-m', strtotime('-1 month'));
$sqlComparativa = "SELECT DATE_FORMAT(fecha, '%Y-%m') as mes, COUNT(*) as total 
                   FROM tb_comentarios 
                   WHERE DATE_FORMAT(fecha, '%Y-%m') IN (:actual, :anterior)
                   GROUP BY mes";
$queryComparativa = $pdo->prepare($sqlComparativa);
$queryComparativa->execute([
    ':actual' => $mesActual,
    ':anterior' => $mesAnterior
]);
$datosComparativa = $queryComparativa->fetchAll(PDO::FETCH_KEY_PAIR);
$comparativaMeses = [
    $mesAnterior => $datosComparativa[$mesAnterior] ?? 0,
    $mesActual => $datosComparativa[$mesActual] ?? 0
];

?>

<?php
include_once '../../app/config.php';

// Obtener filtros
$filtro_nivel = isset($_GET['nivel']) ? $_GET['nivel'] : '';
$filtro_fecha_desde = isset($_GET['fecha_desde']) ? $_GET['fecha_desde'] : '';
$filtro_fecha_hasta = isset($_GET['fecha_hasta']) ? $_GET['fecha_hasta'] : '';

// Construcción de query con filtros
$where_conditions = [];
$params = [];

if (!empty($filtro_nivel)) {
    $where_conditions[] = "c.nivel_cliente = :nivel";
    $params[':nivel'] = $filtro_nivel;
}

if (!empty($filtro_fecha_desde)) {
    $where_conditions[] = "c.fecha_ultima_visita >= :fecha_desde";
    $params[':fecha_desde'] = $filtro_fecha_desde;
}

if (!empty($filtro_fecha_hasta)) {
    $where_conditions[] = "c.fecha_ultima_visita <= :fecha_hasta";
    $params[':fecha_hasta'] = $filtro_fecha_hasta;
}

$where_clause = !empty($where_conditions) ? 'WHERE ' . implode(' AND ', $where_conditions) : '';

// Consulta para exportar
$sql_export = "SELECT 
    c.id_cliente as 'ID Cliente',
    u.nombre_completo as 'Nombre Completo',
    u.telefono as 'Teléfono',
    u.email as 'Email',
    c.nivel_cliente as 'Nivel Cliente',
    c.acumulado_puntos as 'Puntos Acumulados',
    c.fecha_ultima_visita as 'Última Visita',
    COUNT(v.id_venta) as 'Total Compras',
    COALESCE(SUM(v.total_venta), 0) as 'Total Gastado',
    CASE 
        WHEN DATEDIFF(NOW(), c.fecha_ultima_visita) > 30 OR c.fecha_ultima_visita IS NULL THEN 'Inactivo'
        WHEN DATEDIFF(NOW(), c.fecha_ultima_visita) > 15 THEN 'En Riesgo'
        ELSE 'Activo'
    END as 'Estado'
FROM tb_clientes c
INNER JOIN tb_usuarios u ON c.id_usuario = u.id_usuario
LEFT JOIN tb_ventas v ON c.id_cliente = v.id_cliente
$where_clause
GROUP BY c.id_cliente, u.nombre_completo, u.telefono, u.email, c.acumulado_puntos, c.nivel_cliente, c.fecha_ultima_visita
ORDER BY c.fecha_ultima_visita DESC";

$stmt_export = $pdo->prepare($sql_export);
$stmt_export->execute($params);
$clientes_export = $stmt_export->fetchAll(PDO::FETCH_ASSOC);

// Configurar headers para descarga de Excel
$filename = "reporte_clientes_" . date('Y-m-d_H-i-s') . ".csv";
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=' . $filename);

// Crear el archivo CSV
$output = fopen('php://output', 'w');

// BOM para UTF-8
fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

// Escribir encabezados
if (!empty($clientes_export)) {
    fputcsv($output, array_keys($clientes_export[0]), ';');
    
    // Escribir datos
    foreach ($clientes_export as $cliente) {
        fputcsv($output, $cliente, ';');
    }
}

fclose($output);
exit();
?>
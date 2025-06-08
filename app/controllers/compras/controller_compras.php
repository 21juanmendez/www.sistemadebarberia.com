<?php
// Obtener filtros si se envían por GET
$filtro_estado = isset($_GET['estado']) ? $_GET['estado'] : '';
$filtro_fecha = isset($_GET['fecha']) ? $_GET['fecha'] : '';
$filtro_proveedor = isset($_GET['proveedor']) ? $_GET['proveedor'] : '';

// Construir la consulta SQL base
$sql_compras = "SELECT c.*, p.nombre_empresa, u.nombre_completo 
                FROM tb_compras c
                INNER JOIN tb_proveedores p ON c.id_proveedor = p.id_proveedor
                INNER JOIN tb_usuarios u ON c.id_usuario = u.id_usuario";

// Array para almacenar las condiciones WHERE
$condiciones = [];
$parametros = [];

// Agregar filtros si existen
if (!empty($filtro_estado)) {
    $condiciones[] = "c.estado = :estado";
    $parametros[':estado'] = $filtro_estado;
}

if (!empty($filtro_fecha)) {
    $condiciones[] = "DATE(c.fecha_compra) = :fecha";
    $parametros[':fecha'] = $filtro_fecha;
}

if (!empty($filtro_proveedor)) {
    $condiciones[] = "p.id_proveedor = :proveedor";
    $parametros[':proveedor'] = $filtro_proveedor;
}

// Agregar condiciones WHERE si existen
if (!empty($condiciones)) {
    $sql_compras .= " WHERE " . implode(" AND ", $condiciones);
}

// Ordenar por fecha de creación descendente
$sql_compras .= " ORDER BY c.fyh_creacion DESC";

// Preparar y ejecutar la consulta
$query_compras = $pdo->prepare($sql_compras);

// Bind de los parámetros
foreach ($parametros as $param => $valor) {
    $query_compras->bindParam($param, $valor);
}

$query_compras->execute();
$compras = $query_compras->fetchAll(PDO::FETCH_ASSOC);

// Obtener estadísticas de compras por estado
$sql_stats = "SELECT 
                estado,
                COUNT(*) as cantidad,
                SUM(total_compra) as total_monto
              FROM tb_compras 
              GROUP BY estado";

$query_stats = $pdo->prepare($sql_stats);
$query_stats->execute();
$estadisticas = $query_stats->fetchAll(PDO::FETCH_ASSOC);

// Convertir estadísticas a un array asociativo para fácil acceso
$stats_por_estado = [];
foreach ($estadisticas as $stat) {
    $stats_por_estado[$stat['estado']] = [
        'cantidad' => $stat['cantidad'],
        'total_monto' => $stat['total_monto']
    ];
}
?>
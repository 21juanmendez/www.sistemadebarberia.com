<?php
// Obtener filtros de la URL
$filtro_nivel = isset($_GET['nivel']) ? $_GET['nivel'] : '';
$filtro_fecha_desde = isset($_GET['fecha_desde']) ? $_GET['fecha_desde'] : '';
$filtro_fecha_hasta = isset($_GET['fecha_hasta']) ? $_GET['fecha_hasta'] : '';

// Consulta base para estadísticas generales
$sql_total_clientes = "SELECT COUNT(*) as total FROM tb_clientes";
$resultado_total = $pdo->prepare($sql_total_clientes);
$resultado_total->execute();
$total_clientes = $resultado_total->fetch()['total'];

// Clientes frecuentes
$sql_frecuentes = "SELECT COUNT(*) as total FROM tb_clientes WHERE nivel_cliente = 'Frecuente'";
$resultado_frecuentes = $pdo->prepare($sql_frecuentes);
$resultado_frecuentes->execute();
$total_frecuentes = $resultado_frecuentes->fetch()['total'];

// Clientes sin compras (que no aparecen en tb_ventas)
$sql_sin_compras = "SELECT COUNT(*) as total FROM tb_clientes c 
                    LEFT JOIN tb_ventas v ON c.id_cliente = v.id_cliente 
                    WHERE v.id_cliente IS NULL";
$resultado_sin_compras = $pdo->prepare($sql_sin_compras);
$resultado_sin_compras->execute();
$total_sin_compras = $resultado_sin_compras->fetch()['total'];

// Clientes inactivos (más de 30 días sin visita)
$sql_inactivos = "SELECT COUNT(*) as total FROM tb_clientes 
                  WHERE fecha_ultima_visita < DATE_SUB(NOW(), INTERVAL 30 DAY) 
                  OR fecha_ultima_visita IS NULL";
$resultado_inactivos = $pdo->prepare($sql_inactivos);
$resultado_inactivos->execute();
$total_inactivos = $resultado_inactivos->fetch()['total'];

// Construcción de query con filtros para la tabla
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

// Consulta principal con filtros
$sql_clientes = "SELECT 
    u.nombre_completo,
    u.telefono,
    u.email,
    c.acumulado_puntos,
    c.nivel_cliente,
    c.fecha_ultima_visita,
    COUNT(v.id_venta) as total_compras,
    COALESCE(SUM(v.total_venta), 0) as total_gastado,
    DATEDIFF(NOW(), c.fecha_ultima_visita) as dias_inactivo
FROM tb_clientes c
INNER JOIN tb_usuarios u ON c.id_usuario = u.id_usuario
LEFT JOIN tb_ventas v ON c.id_cliente = v.id_cliente
$where_clause
GROUP BY c.id_cliente, u.nombre_completo, u.telefono, u.email, c.acumulado_puntos, c.nivel_cliente, c.fecha_ultima_visita
ORDER BY total_gastado DESC";

$stmt_clientes = $pdo->prepare($sql_clientes);
$stmt_clientes->execute($params);
$clientes = $stmt_clientes->fetchAll(PDO::FETCH_ASSOC);

// Datos para gráficas
// Distribución por nivel de cliente
$sql_grafica_niveles = "SELECT nivel_cliente, COUNT(*) as cantidad 
                        FROM tb_clientes 
                        GROUP BY nivel_cliente";
$stmt_niveles = $pdo->prepare($sql_grafica_niveles);
$stmt_niveles->execute();
$datos_niveles = $stmt_niveles->fetchAll(PDO::FETCH_ASSOC);

// Clientes por mes (últimos 6 meses)
$sql_grafica_meses = "SELECT 
    DATE_FORMAT(fecha_ultima_visita, '%Y-%m') as mes,
    COUNT(*) as cantidad
FROM tb_clientes 
WHERE fecha_ultima_visita >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
GROUP BY DATE_FORMAT(fecha_ultima_visita, '%Y-%m')
ORDER BY mes";
$stmt_meses = $pdo->prepare($sql_grafica_meses);
$stmt_meses->execute();
$datos_meses = $stmt_meses->fetchAll(PDO::FETCH_ASSOC);

//Formatear meses a mes año(Mayo 2025)
foreach ($datos_meses as &$dato) {
    $dato['mes'] = date('F Y', strtotime($dato['mes']));
}

// Top 5 clientes por gasto
$sql_top_clientes = "SELECT 
    u.nombre_completo,
    SUM(v.total_venta) as total_gastado,
    COUNT(v.id_venta) as total_compras
FROM tb_clientes c
INNER JOIN tb_usuarios u ON c.id_usuario = u.id_usuario
INNER JOIN tb_ventas v ON c.id_cliente = v.id_cliente
GROUP BY c.id_cliente, u.nombre_completo
ORDER BY total_gastado DESC
LIMIT 5";
$stmt_top = $pdo->prepare($sql_top_clientes);
$stmt_top->execute();
$top_clientes = $stmt_top->fetchAll(PDO::FETCH_ASSOC);

// Promedio de puntos por nivel
$sql_promedio_puntos = "SELECT 
    nivel_cliente,
    AVG(acumulado_puntos) as promedio_puntos,
    COUNT(*) as cantidad_clientes
FROM tb_clientes 
GROUP BY nivel_cliente";
$stmt_promedio = $pdo->prepare($sql_promedio_puntos);
$stmt_promedio->execute();
$promedio_puntos = $stmt_promedio->fetchAll(PDO::FETCH_ASSOC);

//Generar colores aleatorios para gráficas

function randomColor() {
    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
}

//generar colores para top clientes
$top_clientes_colores = [];
foreach ($top_clientes as $cliente) {
    $top_clientes_colores[] = randomColor();
}

// Preparar datos para JavaScript
$niveles_labels = json_encode(array_column($datos_niveles, 'nivel_cliente'));
$niveles_data = json_encode(array_column($datos_niveles, 'cantidad'));

$meses_labels = json_encode(array_column($datos_meses, 'mes'));
$meses_data = json_encode(array_column($datos_meses, 'cantidad'));

$top_clientes_labels = json_encode(array_column($top_clientes, 'nombre_completo'));
$top_clientes_data = json_encode(array_column($top_clientes, 'total_gastado'));
$top_clientes_colores = json_encode($top_clientes_colores);

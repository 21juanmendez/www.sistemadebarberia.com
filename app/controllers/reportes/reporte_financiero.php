<?php
$mes_actual = $_GET['mes'] ?? date('m');
$anio_actual = $_GET['anio'] ?? date('Y');

// Validar formato de mes y año
if (!preg_match('/^(0[1-9]|1[0-2])$/', $mes_actual)) {
    $mes_actual = date('m');
}
if (!preg_match('/^\d{4}$/', $anio_actual) || $anio_actual < 2020 || $anio_actual > date('Y')) {
    $anio_actual = date('Y');
}

try {
    // ===== CÁLCULO DE INGRESOS TOTALES =====
    $query_ingresos = "
        SELECT 
            COALESCE(SUM(total_venta), 0) as ingresos_totales,
            COUNT(*) as total_ventas
        FROM tb_ventas 
        WHERE MONTH(fyh_creacion) = :mes 
        AND YEAR(fyh_creacion) = :anio
        AND completa = 1
    ";

    $stmt_ingresos = $pdo->prepare($query_ingresos);
    $stmt_ingresos->execute([':mes' => $mes_actual, ':anio' => $anio_actual]);
    $datos_ingresos = $stmt_ingresos->fetch(PDO::FETCH_ASSOC);

    $ingresos_totales = $datos_ingresos['ingresos_totales'];
    $total_ventas = $datos_ingresos['total_ventas'];

    // ===== CÁLCULO DE INGRESOS MES ANTERIOR (para comparación) =====
    $mes_anterior = ($mes_actual == '01') ? '12' : str_pad($mes_actual - 1, 2, '0', STR_PAD_LEFT);
    $anio_anterior = ($mes_actual == '01') ? $anio_actual - 1 : $anio_actual;

    $query_ingresos_anterior = "
        SELECT COALESCE(SUM(total_venta), 0) as ingresos_anteriores
        FROM tb_ventas 
        WHERE MONTH(fyh_creacion) = :mes 
        AND YEAR(fyh_creacion) = :anio
        AND completa = 1
    ";

    $stmt_ingresos_anterior = $pdo->prepare($query_ingresos_anterior);
    $stmt_ingresos_anterior->execute([':mes' => $mes_anterior, ':anio' => $anio_anterior]);
    $ingresos_anteriores = $stmt_ingresos_anterior->fetch(PDO::FETCH_ASSOC)['ingresos_anteriores'];

    // Calcular porcentaje de cambio en ingresos
    $cambio_ingresos = 0;
    if ($ingresos_anteriores > 0) {
        $cambio_ingresos = (($ingresos_totales - $ingresos_anteriores) / $ingresos_anteriores) * 100;
    }

    // ===== CÁLCULO DE EGRESOS TOTALES =====
    $query_egresos = "
        SELECT COALESCE(SUM(monto), 0) as egresos_totales
        FROM tb_gastos 
        WHERE MONTH(fecha_gasto) = :mes 
        AND YEAR(fecha_gasto) = :anio
    ";

    $stmt_egresos = $pdo->prepare($query_egresos);
    $stmt_egresos->execute([':mes' => $mes_actual, ':anio' => $anio_actual]);
    $egresos_totales = $stmt_egresos->fetch(PDO::FETCH_ASSOC)['egresos_totales'];

    // ===== CÁLCULO DE EGRESOS MES ANTERIOR =====
    $query_egresos_anterior = "
        SELECT COALESCE(SUM(monto), 0) as egresos_anteriores
        FROM tb_gastos 
        WHERE MONTH(fecha_gasto) = :mes 
        AND YEAR(fecha_gasto) = :anio
    ";

    $stmt_egresos_anterior = $pdo->prepare($query_egresos_anterior);
    $stmt_egresos_anterior->execute([':mes' => $mes_anterior, ':anio' => $anio_anterior]);
    $egresos_anteriores = $stmt_egresos_anterior->fetch(PDO::FETCH_ASSOC)['egresos_anteriores'];

    // Calcular porcentaje de cambio en egresos
    $cambio_egresos = 0;
    if ($egresos_anteriores > 0) {
        $cambio_egresos = (($egresos_totales - $egresos_anteriores) / $egresos_anteriores) * 100;
    }

    // ===== CÁLCULO DE UTILIDAD NETA =====
    $utilidad_neta = $ingresos_totales - $egresos_totales;
    $margen_utilidad = ($ingresos_totales > 0) ? ($utilidad_neta / $ingresos_totales) * 100 : 0;

    // ===== CÁLCULO DE CLIENTES ATENDIDOS =====
    $query_clientes = "
        SELECT 
            COUNT(DISTINCT CASE WHEN id_cliente IS NOT NULL THEN id_cliente END) as clientes_unicos,
            COUNT(*) as total_transacciones
        FROM tb_ventas 
        WHERE MONTH(fyh_creacion) = :mes 
        AND YEAR(fyh_creacion) = :anio
        AND completa = 1
    ";

    $stmt_clientes = $pdo->prepare($query_clientes);
    $stmt_clientes->execute([':mes' => $mes_actual, ':anio' => $anio_actual]);
    $datos_clientes = $stmt_clientes->fetch(PDO::FETCH_ASSOC);

    $clientes_atendidos = $datos_clientes['clientes_unicos'] ?: $datos_clientes['total_transacciones'];
    $ticket_promedio = ($total_ventas > 0) ? $ingresos_totales / $total_ventas : 0;

    // ===== DESGLOSE POR PRODUCTOS Y SERVICIOS =====
    $query_desglose = "
        SELECT 
            COALESCE(SUM(subtotal_productos), 0) as ingresos_productos,
            COALESCE(SUM(subtotal_servicios), 0) as ingresos_servicios
        FROM tb_ventas 
        WHERE MONTH(fyh_creacion) = :mes 
        AND YEAR(fyh_creacion) = :anio
        AND completa = 1
    ";

    $stmt_desglose = $pdo->prepare($query_desglose);
    $stmt_desglose->execute([':mes' => $mes_actual, ':anio' => $anio_actual]);
    $desglose = $stmt_desglose->fetch(PDO::FETCH_ASSOC);

    $ingresos_productos = $desglose['ingresos_productos'];
    $ingresos_servicios = $desglose['ingresos_servicios'];

    // Detalle de los ingresos por servicios
    $query_detalle_servicios = "
        SELECT 
    s.nombre_servicio as servicio,
    COALESCE(SUM(CASE 
        WHEN MONTH(v.fyh_creacion) = :mes
         AND YEAR(v.fyh_creacion) = :anio
         AND v.completa = 1 
        THEN vs.cantidad * vs.precio 
        ELSE 0 
    END), 0) as total_servicio
FROM tb_servicios s
LEFT JOIN tb_ventas_servicio vs ON s.id_servicio = vs.id_servicio
LEFT JOIN tb_ventas v ON vs.id_venta = v.id_venta
GROUP BY s.id_servicio, s.nombre_servicio
ORDER BY total_servicio DESC
    ";
    $stmt_detalle_servicios = $pdo->prepare($query_detalle_servicios);
    $stmt_detalle_servicios->execute([':mes' => $mes_actual, ':anio' => $anio_actual]);
    $detalle_servicios = $stmt_detalle_servicios->fetchAll(PDO::FETCH_ASSOC);


    // Detalle de los ingresos por productos por categoría
    $query_detalle_productos = "
        SELECT 
    c.nombre AS categoria,
    COALESCE(SUM(CASE 
        WHEN YEAR(v.fyh_creacion) = :anio
         AND MONTH(v.fyh_creacion) = :mes
         AND v.completa = 1 
        THEN vp.cantidad * vp.precio 
        ELSE 0 
    END), 0) AS total_ventas
    FROM tb_categorias c
    LEFT JOIN tb_productos p ON c.id_categoria = p.id_categoria
    LEFT JOIN tb_ventas_producto vp ON p.id_producto = vp.id_producto
    LEFT JOIN tb_ventas v ON vp.id_venta = v.id_venta
    GROUP BY c.id_categoria, c.nombre
    ORDER BY total_ventas DESC";
    $stmt_detalle_productos = $pdo->prepare($query_detalle_productos);
    $stmt_detalle_productos->execute([':mes' => $mes_actual, ':anio' => $anio_actual]);
    $detalle_productos = $stmt_detalle_productos->fetchAll(PDO::FETCH_ASSOC);

    // ===== GASTOS POR CATEGORÍA =====
    $query_gastos_categoria = "
        SELECT 
            c.nombre as categoria,
            COALESCE(SUM(g.monto), 0) as total_categoria
        FROM tb_categorias_gastos c
        LEFT JOIN tb_gastos g ON c.id_categoria_gasto = g.id_categoria_gasto 
            AND MONTH(g.fecha_gasto) = :mes 
            AND YEAR(g.fecha_gasto) = :anio
        GROUP BY c.id_categoria_gasto, c.nombre
        ORDER BY total_categoria DESC
    ";

    $stmt_gastos_categoria = $pdo->prepare($query_gastos_categoria);
    $stmt_gastos_categoria->execute([':mes' => $mes_actual, ':anio' => $anio_actual]);
    $gastos_por_categoria = $stmt_gastos_categoria->fetchAll(PDO::FETCH_ASSOC);

    // ===== TOP 3 SERVICIOS MÁS RENTABLES =====
    $query_top_servicios = "
SELECT 
    s.nombre_servicio,
    COALESCE(SUM(vs.cantidad * vs.precio), 0) as ingreso_total,
    COUNT(vs.id_venta_servicio) as veces_vendido
FROM tb_servicios s
LEFT JOIN tb_ventas_servicio vs ON s.id_servicio = vs.id_servicio
LEFT JOIN tb_ventas v ON vs.id_venta = v.id_venta
WHERE MONTH(v.fyh_creacion) = :mes 
AND YEAR(v.fyh_creacion) = :anio
AND v.completa = 1
GROUP BY s.id_servicio, s.nombre_servicio
HAVING ingreso_total > 0
ORDER BY ingreso_total DESC
LIMIT 3
";

    $stmt_top_servicios = $pdo->prepare($query_top_servicios);
    $stmt_top_servicios->execute([':mes' => $mes_actual, ':anio' => $anio_actual]);
    $top_servicios = $stmt_top_servicios->fetchAll(PDO::FETCH_ASSOC);

    // ===== TOP 3 PRODUCTOS MÁS RENTABLES POR CATEGORÍA =====
    $query_top_productos = "
SELECT 
    p.nombre_producto as producto,
    c.nombre as categoria,
    COALESCE(SUM(vp.cantidad * vp.precio), 0) as ingreso_total,
    SUM(vp.cantidad) as cantidad_vendida,
    (((p.precio_venta - p.precio_compra)/p.precio_venta)*100) AS margen
FROM tb_productos p
INNER JOIN tb_categorias c ON p.id_categoria = c.id_categoria
LEFT JOIN tb_ventas_producto vp ON p.id_producto = vp.id_producto
LEFT JOIN tb_ventas v ON vp.id_venta = v.id_venta
WHERE MONTH(v.fyh_creacion) = :mes 
AND YEAR(v.fyh_creacion) = :anio
AND v.completa = 1
GROUP BY p.id_producto, p.nombre_producto, c.nombre
HAVING ingreso_total > 0
ORDER BY ingreso_total DESC
LIMIT 3
";

    $stmt_top_productos = $pdo->prepare($query_top_productos);
    $stmt_top_productos->execute([':mes' => $mes_actual, ':anio' => $anio_actual]);
    $top_productos = $stmt_top_productos->fetchAll(PDO::FETCH_ASSOC);


    // ===== CÁLCULO DE MARGEN BRUTO (basado en costo vs precio de venta) =====
    $query_margen_bruto = "
SELECT 
    COALESCE(SUM(vp.cantidad * p.precio_compra), 0) as costo_total_productos,
    COALESCE(SUM(vp.cantidad * vp.precio), 0) as venta_total_productos
FROM tb_ventas_producto vp
INNER JOIN tb_productos p ON vp.id_producto = p.id_producto
INNER JOIN tb_ventas v ON vp.id_venta = v.id_venta
WHERE MONTH(v.fyh_creacion) = :mes 
AND YEAR(v.fyh_creacion) = :anio
AND v.completa = 1
";

    $stmt_margen_bruto = $pdo->prepare($query_margen_bruto);
    $stmt_margen_bruto->execute([':mes' => $mes_actual, ':anio' => $anio_actual]);
    $datos_margen = $stmt_margen_bruto->fetch(PDO::FETCH_ASSOC);

    $costo_total_productos = $datos_margen['costo_total_productos'];
    $venta_total_productos = $datos_margen['venta_total_productos'];

    // Margen bruto = (Ventas - Costos) / Ventas * 100
    // Para servicios asumimos 85% de margen (sin costo de materiales)
    $ingresos_totales_ajustados = $venta_total_productos + $ingresos_servicios;
    $costos_totales_productos = $costo_total_productos + ($ingresos_servicios * 0.15); // 15% costo operativo servicios

    $margen_bruto = ($ingresos_totales_ajustados > 0) ?
        (($ingresos_totales_ajustados - $costos_totales_productos) / $ingresos_totales_ajustados) * 100 : 0;

    // ===== OBTENER EGRESOS SIN COMPRAS A PROVEEDORES =====
    $query_egresos_sin_compras = "
SELECT
    COALESCE(SUM(g.monto), 0) as egresos_totales
FROM tb_gastos g
INNER JOIN tb_categorias_gastos gc ON g.id_categoria_gasto = gc.id_categoria_gasto
WHERE MONTH(fecha_gasto) = :mes
AND YEAR(fecha_gasto) = :anio
AND gc.nombre != 'Compras a Proveedores'
";
    $stmt_egresos_sin_compras = $pdo->prepare($query_egresos_sin_compras);
    $stmt_egresos_sin_compras->execute([':mes' => $mes_actual, ':anio' => $anio_actual]);
    $egresos_totales_c = $stmt_egresos_sin_compras->fetch(PDO::FETCH_ASSOC)['egresos_totales'] ?? 0;

    // Margen operativo = (Ingresos - Costos - Gastos) / Ingresos * 100
    $margen_operativo = ($ingresos_totales > 0) ?
        (($ingresos_totales - $egresos_totales_c) / $ingresos_totales) * 100 : 0;

    // ROI = (Utilidad Neta / Gastos Totales) * 100
    $roi = ($egresos_totales > 0) ? ($utilidad_neta / $egresos_totales) * 100 : 0;

    // ===== CLIENTES NUEVOS DEL MES =====
    $query_clientes_nuevos = "
SELECT COUNT(*) as clientes_nuevos
FROM tb_clientes c
INNER JOIN tb_usuarios u ON c.id_usuario = u.id_usuario
WHERE MONTH(u.fyh_creacion) = :mes 
AND YEAR(u.fyh_creacion) = :anio
";

    $stmt_clientes_nuevos = $pdo->prepare($query_clientes_nuevos);
    $stmt_clientes_nuevos->execute([':mes' => $mes_actual, ':anio' => $anio_actual]);
    $clientes_nuevos = $stmt_clientes_nuevos->fetch(PDO::FETCH_ASSOC)['clientes_nuevos'] ?? 0;

    // ===== CLIENTES TOTALES =====
    $query_clientes_totales = "
SELECT COUNT(*) as total_clientes
FROM tb_clientes
";

    $stmt_clientes_totales = $pdo->prepare($query_clientes_totales);
    $stmt_clientes_totales->execute();
    $total_clientes = $stmt_clientes_totales->fetch(PDO::FETCH_ASSOC)['total_clientes'] ?? 0;

    // ===== TASA DE RECURRENCIA =====
    $query_recurrencia = "
SELECT 
    COUNT(DISTINCT c.id_cliente) as clientes_recurrentes
FROM tb_clientes c
INNER JOIN tb_ventas v ON c.id_cliente = v.id_cliente
WHERE MONTH(v.fyh_creacion) = :mes 
AND YEAR(v.fyh_creacion) = :anio
AND v.completa = 1
AND c.fecha_ultima_visita < DATE_SUB(CONCAT(:anio, '-', :mes, '-01'), INTERVAL 1 MONTH)
";

    $stmt_recurrencia = $pdo->prepare($query_recurrencia);
    $stmt_recurrencia->execute([':mes' => $mes_actual, ':anio' => $anio_actual]);
    $clientes_recurrentes = $stmt_recurrencia->fetch(PDO::FETCH_ASSOC)['clientes_recurrentes'] ?? 0;

    $tasa_recurrencia = ($clientes_atendidos > 0) ? ($clientes_recurrentes / $clientes_atendidos) * 100 : 0;
} catch (Exception $e) {
    // En caso de error, establecer valores por defecto
    $ingresos_totales = 0;
    $egresos_totales = 0;
    $utilidad_neta = 0;
    $margen_utilidad = 0;
    $clientes_atendidos = 0;
    $ticket_promedio = 0;
    $cambio_ingresos = 0;
    $cambio_egresos = 0;
    $ingresos_productos = 0;
    $ingresos_servicios = 0;
    $gastos_por_categoria = [];

    // Log del error (opcional)
    error_log("Error en reporte financiero: " . $e->getMessage());
}

// Función helper para formatear números
function formatearMoneda($valor)
{
    return number_format($valor, 2, '.', ',');
}

function formatearPorcentaje($valor)
{
    return number_format($valor, 1);
}
function calcularMargenAproximado($ingreso_total)
{
    // Márgenes aproximados basados en el ingreso
    if ($ingreso_total >= 1000) return 85;
    if ($ingreso_total >= 500) return 75;
    if ($ingreso_total >= 200) return 65;
    return 55;
}
function obtenerClaseProgreso($porcentaje) {
    if ($porcentaje >= 70) return 'bg-success';
    if ($porcentaje >= 40) return 'bg-primary';
    if ($porcentaje >= 20) return 'bg-info';
    if ($porcentaje <= 0) return 'bg-danger';
    return 'bg-warning';
}

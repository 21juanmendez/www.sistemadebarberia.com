<?php

$fyh_inicio = '';
$fyh_fin = '';
$fyh_actual = date('Y-m-d 23:59:59');
$cantidad_ventas = 0;
$productos_vendidos = 0;
$servicios_brindados = 0;
$mensaje = '';
$total_vendido = 0;
$arry_grafico = array();

if (isset($_GET['fecha_inicio']) && isset($_GET['fecha_fin'])) {
    $fyh_inicio = $_GET['fecha_inicio'] . ' 00:00:00';
    $fyh_fin = $_GET['fecha_fin'] . ' 23:59:59';
    //Obtener el numero de ventas entre las fechas seleccionadas
    $cantidad_ventas = obtenerCantidadVenta($pdo, $fyh_inicio, $fyh_fin);
    $mensaje = 'Ventas entre ' . date('d/m/y', strtotime($fyh_inicio)) . ' y ' . date('d/m/y', strtotime($fyh_fin));
    $productos_vendidos = obtenerProductosVendidos($pdo, $fyh_inicio, $fyh_fin);
    $servicios_brindados = obtenerServiciosBrindados($pdo, $fyh_inicio, $fyh_fin);
    $total_vendido = obtenerTotalVendido($pdo, $fyh_inicio, $fyh_fin);
    $arry_grafico = graficoVenta($pdo, $fyh_inicio, $fyh_fin);
} else {
    $fyh_inicio = date('Y-m-d 00:00:00', strtotime($fyh_actual . ' - 1 month'));
    $fyh_fin = $fyh_actual;
    //Obtener el numero de ventas entre las fechas seleccionadas
    $cantidad_ventas = obtenerCantidadVenta($pdo, $fyh_inicio, $fyh_fin);
    $mensaje = 'Ventas del ultimo mes';
    $productos_vendidos = obtenerProductosVendidos($pdo, $fyh_inicio, $fyh_fin);
    $servicios_brindados = obtenerServiciosBrindados($pdo, $fyh_inicio, $fyh_fin);
    $total_vendido = obtenerTotalVendido($pdo, $fyh_inicio, $fyh_fin);
    $arry_grafico = graficoVenta($pdo, $fyh_inicio, $fyh_fin);
}

function obtenerProductosVendidos($pdo, $fyh_inicio, $fyh_fin)
{
    $sql = "SELECT SUM(p.cantidad) as productos 
            FROM tb_ventas v 
            INNER JOIN tb_ventas_producto p ON v.id_venta = p.id_venta 
            WHERE v.fyh_creacion BETWEEN '$fyh_inicio' AND '$fyh_fin'";
    $query = $pdo->prepare($sql);
    $query->execute();
    $productos_v = $query->fetch(PDO::FETCH_ASSOC);
    return $productos_v['productos'];
}
function obtenerServiciosBrindados($pdo, $fyh_inicio, $fyh_fin)
{
    $sql = "SELECT SUM(s.cantidad) as servicios 
            FROM tb_ventas v 
            INNER JOIN tb_ventas_servicio s ON v.id_venta = s.id_venta 
            WHERE v.fyh_creacion BETWEEN '$fyh_inicio' AND '$fyh_fin'";
    $query = $pdo->prepare($sql);
    $query->execute();
    $servicios = $query->fetch(PDO::FETCH_ASSOC);
    return $servicios['servicios'];
}

function obtenerCantidadVenta($pdo, $fyh_inicio, $fyh_fin)
{
    $sql = "SELECT COUNT(*) as ventas FROM tb_ventas WHERE fyh_creacion BETWEEN '$fyh_inicio' AND '$fyh_fin'";
    $query = $pdo->prepare($sql);
    $query->execute();
    $cantidad_v = $query->fetch(PDO::FETCH_ASSOC);
    return $cantidad_v['ventas'];
}
function obtenerTotalVendido($pdo, $fyh_inicio, $fyh_fin)
{
    $sql = "SELECT SUM(total_venta) as total FROM tb_ventas WHERE fyh_creacion BETWEEN '$fyh_inicio' AND '$fyh_fin'";
    $query = $pdo->prepare($sql);
    $query->execute();
    $total_v = $query->fetch(PDO::FETCH_ASSOC);
    return $total_v['total'];
}

function graficoVenta($pdo, $fyh_inicio, $fyh_fin)
{
    $sql = "SELECT DATE(fyh_creacion) as fecha, SUM(total_venta) as total 
            FROM tb_ventas 
            WHERE fyh_creacion BETWEEN '$fyh_inicio' AND '$fyh_fin' 
            GROUP BY DATE(fyh_creacion)";
    $query = $pdo->prepare($sql);
    $query->execute();
    $ventas = $query->fetchAll(PDO::FETCH_ASSOC);
    $fechas = '';
    $totales = '';
    foreach ($ventas as $venta) {
        $fechas .= '"' . $venta['fecha'] . '",';
        $totales .= $venta['total'] . ',';
    }
    $fechas = substr($fechas, 0, -1);
    $totales = substr($totales, 0, -1);
    return array($fechas, $totales);
}

<?php

$fyh_inicio = '';
$fyh_fin = '';
$fyh_actual = date('Y-m-d 23:59:59');
$cantidad_ventas = 0;
$productos_vendidos = 0;
$servicios_brindados = 0;
$mensaje = ''; //Mensaje de ventas
$total_vendido = 0;
$arry_grafico = array(); //Grafico de ventas
$arry_grafico3 = array(); //Grafico de productos vendidos por categoria
$arry_grafico_servicios = array(); //Grafico de servicios brindados
$filter = 0;

if (isset($_GET['fecha_inicio']) && isset($_GET['fecha_fin'])) {
    $fyh_inicio = $_GET['fecha_inicio'] . ' 00:00:00';
    $fyh_fin = $_GET['fecha_fin'] . ' 23:59:59';
    $filter = $_GET['f'];
    //Obtener el numero de ventas entre las fechas seleccionadas
    $cantidad_ventas = obtenerCantidadVenta($pdo, $fyh_inicio, $fyh_fin);
    $mensaje = ' Ventas entre ' . date('d/m/y', strtotime($fyh_inicio)) . ' hasta ' . date('d/m/y', strtotime($fyh_fin));
    $productos_vendidos = obtenerProductosVendidos($pdo, $fyh_inicio, $fyh_fin);
    if($productos_vendidos == null){
        $productos_vendidos = 0;
    }
    $servicios_brindados = obtenerServiciosBrindados($pdo, $fyh_inicio, $fyh_fin);
    if($servicios_brindados == null){
        $servicios_brindados = 0;
    }
    $total_vendido = obtenerTotalVendido($pdo, $fyh_inicio, $fyh_fin);
    if($total_vendido == null){
        $total_vendido = 0;
    }
    $arry_grafico = graficoVenta($pdo, $fyh_inicio, $fyh_fin);
    $arry_grafico3 = productosPorCategoria($pdo, $fyh_inicio, $fyh_fin);
    $arry_grafico_servicios = serviciosPorCategoria($pdo, $fyh_inicio, $fyh_fin);
} else {
    // $fyh_inicio = date('Y-m-d 00:00:00', strtotime($fyh_actual . ' - 1 month')); //Ultimo mes
    
    $fyh_inicio = date('Y-m-01 00:00:00'); //Mes actual
    $fyh_fin = $fyh_actual;
    //Obtener el numero de ventas entre las fechas seleccionadas
    $cantidad_ventas = obtenerCantidadVenta($pdo, $fyh_inicio, $fyh_fin);
  
    // $mensaje = ' Ventas del ultimo mes';  //Mensaje de ventas del ultimo mes
    
    $mensaje = ' Ventas del mes actual'; //Mensaje de ventas del mes actual
    $productos_vendidos = obtenerProductosVendidos($pdo, $fyh_inicio, $fyh_fin);
    if($productos_vendidos == null){
        $productos_vendidos = 0;
    }
    $servicios_brindados = obtenerServiciosBrindados($pdo, $fyh_inicio, $fyh_fin);
    if($servicios_brindados == null){
        $servicios_brindados = 0;
    }
    $total_vendido = obtenerTotalVendido($pdo, $fyh_inicio, $fyh_fin);
    if($total_vendido == null){
        $total_vendido = 0;
    }
    $arry_grafico = graficoVenta($pdo, $fyh_inicio, $fyh_fin);
    $arry_grafico3 = productosPorCategoria($pdo, $fyh_inicio, $fyh_fin);
    $arry_grafico_servicios = serviciosPorCategoria($pdo, $fyh_inicio, $fyh_fin);
}

//Productos vendidos
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
//Servicios brindados
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
//Cantidad de ventas
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
//Grafico de ventas
function graficoVenta($pdo, $fyh_inicio, $fyh_fin)
{
    //obtener la cantidad de dias entre las fechas seleccionadas
    $interval = date_diff(date_create($fyh_inicio), date_create($fyh_fin))->days;

    //Mostrar datos por dias
    if ($interval <= 31) {
        $sql = "SELECT fyh_creacion as fecha, SUM(total_venta) as ventas 
                FROM tb_ventas 
                WHERE fyh_creacion BETWEEN '$fyh_inicio' AND '$fyh_fin' 
                GROUP BY fyh_creacion";

        $query = $pdo->prepare($sql);
        $query->execute();
        $ventas = $query->fetchAll(PDO::FETCH_ASSOC);
        $fechas = '';
        $cantidad = '';
        $arry_aux = array();
        $period = new DatePeriod(
            new DateTime($fyh_inicio),
            new DateInterval('P1D'),
            new DateTime($fyh_fin)
        );
        foreach ($period as $date) {
            $fechasUnicas = $date->format('Y-m-d');
            $arry_aux[$fechasUnicas] = 0;
        }

        foreach ($ventas as $venta) {
            $fechasUnicas = date('Y-m-d', strtotime($venta['fecha']));
            $sumCantMismaFecha = $venta['ventas'];
            //Fechas iguales, se sumara las cantidades, y se mostrar la fecha en comun y la suma de las cantidades
            if (isset($arry_aux[$fechasUnicas])) {
                $arry_aux[$fechasUnicas] += $sumCantMismaFecha;
            } else {
                $arry_aux[$fechasUnicas] = $sumCantMismaFecha;
            }
        }

        foreach ($arry_aux as $key => $value) {
            $fechas .= '"' . date('M d', strtotime($key)) . '",';
            $cantidad .= $value . ',';
        }
        $fechas = substr($fechas, 0, -1); //Elimina la ultima coma
        $cantidad = substr($cantidad, 0, -1); //Elimina la ultima coma
        return array($fechas, $cantidad);
    } else {
        //Mostrar datos por semanas
        if ($interval > 31 && $interval <= 180) {
            $sql = "SELECT WEEK(fyh_creacion, 1) as semana, YEAR(fyh_creacion) as year, SUM(total_venta) as ventas 
                    FROM tb_ventas 
                    WHERE fyh_creacion BETWEEN :fyh_inicio AND :fyh_fin 
                    GROUP BY YEAR(fyh_creacion), WEEK(fyh_creacion, 1)";
            
            $query = $pdo->prepare($sql);
            $query->execute([':fyh_inicio' => $fyh_inicio, ':fyh_fin' => $fyh_fin]);
            $ventas = $query->fetchAll(PDO::FETCH_ASSOC);
            
            $fechas = '';
            $cantidad = '';
            $start = new DateTime($fyh_inicio);
            $end = new DateTime($fyh_fin);
            $end->modify('+1 day'); // Para que incluya el ultimo dia
            
            $arry_aux = array();
            $period = new DatePeriod($start, new DateInterval('P1W'), $end);
            
            foreach ($period as $date) {
                $fechasUnicas = $date->format('o-W'); // 'o' for ISO-8601 year number
                $arry_aux[$fechasUnicas] = 0;
            }
            
            foreach ($ventas as $venta) {
                $fechasUnicas = $venta['year'] . '-' . str_pad($venta['semana'], 2, '0', STR_PAD_LEFT);
                $arry_aux[$fechasUnicas] = $venta['ventas'];
            }
            
            foreach ($arry_aux as $key => $value) {
                $weekStart = new DateTime();
                $weekStart->setISODate(substr($key, 0, 4), substr($key, 5));
                $weekEnd = clone $weekStart;
                $weekEnd->modify('+6 days');
                $fechas .= '"' . $weekStart->format('M d') . '-' . $weekEnd->format('d') . '",';
                $cantidad .= $value . ',';
            }
            
            $fechas = substr($fechas, 0, -1); // Elimina la ultima coma
            $cantidad = substr($cantidad, 0, -1); // Elimina la ultima coma
            return array($fechas, $cantidad);
        } else {
            //Mostrar datos por meses
            $sql = "SELECT MONTH(fyh_creacion) as mes, SUM(total_venta) as ventas 
                FROM tb_ventas 
                WHERE fyh_creacion BETWEEN '$fyh_inicio' AND '$fyh_fin' 
                GROUP BY MONTH(fyh_creacion)";

            $query = $pdo->prepare($sql);
            $query->execute();
            $ventas = $query->fetchAll(PDO::FETCH_ASSOC);
            $fechas = '';
            $cantidad = '';
            $start = (new DateTime($fyh_inicio))->modify('first day of this month'); //Primer dia del mes
            $end = (new DateTime($fyh_fin))->modify('first day of next month'); //Primer dia del siguiente mes
            //eliminar el ultimo mes
            $end = $end->modify('-1 day');
            $interval = new DateInterval('P1M');
            $period = new DatePeriod($start, $interval, $end);

            $arry_aux = array();
            foreach ($period as $date) {
                $fechasUnicas = $date->format('Y-m');
                $arry_aux[$fechasUnicas] = 0;
            }

            foreach ($ventas as $venta) {
                $fechasUnicas = date('Y-m', mktime(0, 0, 0, $venta['mes'], 1));
                $arry_aux[$fechasUnicas] = $venta['ventas'];
            }

            foreach ($arry_aux as $key => $value) {
                $fechas .= '"' . date('M', strtotime($key)) . '",';
                $cantidad .= $value . ',';
            }
            $fechas = substr($fechas, 0, -1); //Elimina la ultima coma
            $cantidad = substr($cantidad, 0, -1); //Elimina la ultima coma
            return array($fechas, $cantidad);
        }
    }
}

//Grafico de productos vendidos por categoria
function productosPorCategoria($pdo, $fyh_inicio, $fyh_fin)
{
    $sql = "SELECT c.nombre as categoria, SUM(p.cantidad) as productos 
            FROM tb_ventas v 
            INNER JOIN tb_ventas_producto p ON v.id_venta = p.id_venta 
            INNER JOIN tb_productos pr ON p.id_producto = pr.id_producto 
            INNER JOIN tb_categorias c ON pr.id_categoria = c.id_categoria 
            WHERE v.fyh_creacion BETWEEN '$fyh_inicio' AND '$fyh_fin' 
            GROUP BY c.nombre";
    $query = $pdo->prepare($sql);
    $query->execute();
    $ventas = $query->fetchAll(PDO::FETCH_ASSOC);
    $categorias = '';
    $productos = '';
    $colors = '';
    foreach ($ventas as $venta) {
        $categorias .= '"' . $venta['categoria'] . '",';
        $productos .= $venta['productos'] . ',';
        $colors .= '"' . randomColor() . '",';
    }
    $categorias = substr($categorias, 0, -1);
    $productos = substr($productos, 0, -1);
    $colors = substr($colors, 0, -1);
    return array($categorias, $productos, $colors);
}
//Generar colores aleatorios
function randomColor()
{
    return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
}

//Grafico de servicios brindados por categoria
function serviciosPorCategoria($pdo, $fyh_inicio, $fyh_fin)
{
    $sql = "SELECT se.nombre_servicio as categoria, SUM(s.cantidad) as servicios 
            FROM tb_ventas v 
            INNER JOIN tb_ventas_servicio s ON v.id_venta = s.id_venta 
            INNER JOIN tb_servicios se ON s.id_servicio = se.id_servicio 
            WHERE v.fyh_creacion BETWEEN '$fyh_inicio' AND '$fyh_fin' 
            GROUP BY se.nombre_servicio";
    $query = $pdo->prepare($sql);
    $query->execute();
    $ventas = $query->fetchAll(PDO::FETCH_ASSOC);
    $categorias = '';
    $servicios = '';
    $colors = '';
    foreach ($ventas as $venta) {
        $categorias .= '"' . $venta['categoria'] . '",';
        $servicios .= $venta['servicios'] . ',';
        $colors .= '"' . randomColor() . '",';
    }
    $categorias = substr($categorias, 0, -1);
    $servicios = substr($servicios, 0, -1);
    $colors = substr($colors, 0, -1);
    return array($categorias, $servicios, $colors);
}

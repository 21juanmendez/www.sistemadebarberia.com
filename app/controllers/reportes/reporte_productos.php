<?php

$arry_grafico = array(); //Grafico de productos en stock
$productos_vendidos = 0; //Cantidad de productos vendidos en el ultimo mes
$fecha_actual = date('Y-m-d 23:59:59');
$fecha_mes_anterior = date('Y-m-d 00:00:00', strtotime($fecha_actual . ' - 1 month'));
$top_prod = array(); //Top 5 productos mas vendidos en el ultimo mes

$sql = "SELECT nombre_producto, stock, stock_minimo, stock_maximo FROM  tb_productos ORDER BY stock ASC";
$query = $pdo->prepare($sql);
$query->execute();
$stocks = $query->fetchAll(PDO::FETCH_ASSOC);

$nombre_producto = '';
$stock_disponible = '';
$stock_minimo = '';
$stock_maximo = '';

foreach ($stocks as $stock) {
    $nombre_producto .= '"' . $stock['nombre_producto'] . '",';
    $stock_disponible .= $stock['stock'] . ',';
    $stock_minimo .= $stock['stock_minimo'] . ',';
    $stock_maximo .= $stock['stock_maximo'] . ',';
}

$arry_grafico[0] = substr($nombre_producto, 0, -1);
$arry_grafico[1] = substr($stock_disponible, 0, -1);
$arry_grafico[2] = substr($stock_minimo, 0, -1);
$arry_grafico[3] = substr($stock_maximo, 0, -1);

$productos_vendidos = obtenerProductosVendidos($pdo, $fecha_mes_anterior, $fecha_actual);

//Obtener los 10 productos mas vendidos en el ultimo mes
$sql = "SELECT p.nombre_producto as nombre, SUM(vp.cantidad) as cantidad
 FROM tb_ventas v
    INNER JOIN tb_ventas_producto vp ON v.id_venta = vp.id_venta
    INNER JOIN tb_productos p ON vp.id_producto = p.id_producto
    WHERE v.fyh_creacion BETWEEN '$fecha_mes_anterior' AND '$fecha_actual'
    GROUP BY p.nombre_producto
    ORDER BY cantidad DESC
    LIMIT 5";

$query = $pdo->prepare($sql);
$query->execute();
$top_productos = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($top_productos as $producto) {
    $top_prod[] = array('nombre' => $producto['nombre'], 'cantidad' => $producto['cantidad'], 'color' => randomColor());
}

//Obtener la cantidad de productos vendidos en el ultimo mes
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

//

//funcion ramdom para generar colores oscuros
function randomColor()
{
    return '#' . str_pad(dechex(mt_rand(0, 0x7F7F7F)), 6, '0', STR_PAD_LEFT);//retorna color en formato hexadecimal ejemplo #FFFFFF
}


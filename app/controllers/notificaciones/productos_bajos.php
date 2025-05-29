<?php
$productos_bajos = 0;
$stocks_notif = [];

$sql_notif = "SELECT nombre_producto, stock, stock_minimo FROM tb_productos";
$query_notif = $pdo->prepare($sql_notif);
$query_notif->execute();
$stocks_all = $query_notif->fetchAll(PDO::FETCH_ASSOC);

foreach ($stocks_all as $producto) {
    if ($producto['stock'] <= $producto['stock_minimo']) {
        $productos_bajos++;
        $stocks_notif[] = $producto;
    }
}
?>

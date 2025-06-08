<?php
$id_gasto = $_GET['id_gasto'];

$sql = "SELECT g.*, c.nombre as categoria_nombre 
        FROM tb_gastos g
        INNER JOIN tb_categorias_gastos c ON g.id_categoria_gasto = c.id_categoria_gasto 
        WHERE g.id_gasto = $id_gasto";

$query = $pdo->prepare($sql);
$query->execute();
$gastos = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($gastos as $gasto) {
    $id_gasto = $gasto['id_gasto'];
    $descripcion = $gasto['descripcion'];
    $monto = $gasto['monto'];
    $fecha_gasto = $gasto['fecha_gasto'];
    $fyh_creacion = $gasto['fyh_creacion'];
    $fyh_actualizacion = $gasto['fyh_actualizacion'];
    $categoria_nombre = $gasto['categoria_nombre'];
    $id_categoria_gasto = $gasto['id_categoria_gasto'];
}
?>
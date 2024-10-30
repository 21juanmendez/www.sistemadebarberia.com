<?php
include('../../config.php');

$id_producto = $_POST['id_producto'];

//verificamos si el producto esta asociado a una venta
$consulta = "SELECT COUNT(*) AS cantidadprod FROM tb_ventas_producto WHERE id_producto = $id_producto";
$query1 = $pdo->prepare($consulta);
$query1->execute();
$resultado = $query1->fetch(PDO::FETCH_ASSOC);

if($resultado['cantidadprod'] > 0){
    session_start();
    $_SESSION['mensaje'] = 'No se puede eliminar el producto porque está siendo utilizado en ventas';
    $_SESSION['icono'] = 'warning';
    header('Location:' . $VIEWS . '/productos');
    exit();
}

$sql = "DELETE FROM tb_productos WHERE id_producto = $id_producto";
$query=$pdo->prepare($sql);
if($query->execute()){
    session_start();
    $_SESSION['mensaje'] = 'Producto eliminado correctamente';
    $_SESSION['icono'] = 'success';
    header('Location:' . $VIEWS . '/productos');
}
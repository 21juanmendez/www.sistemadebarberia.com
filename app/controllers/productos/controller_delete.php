<?php
include('../../config.php');

$id_producto = $_POST['id_producto'];

$sql = "DELETE FROM tb_productos WHERE id_producto = $id_producto";
$query=$pdo->prepare($sql);
if($query->execute()){
    session_start();
    $_SESSION['mensaje'] = 'Producto eliminado correctamente';
    $_SESSION['icono'] = 'success';
    header('Location:' . $VIEWS . '/productos');
}
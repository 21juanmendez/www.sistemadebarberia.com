<?php

include('../../config.php');

$id_producto = $_POST['id_producto'];
$id_categoria = $_POST['id_categoria'];
$codigo = $_POST['codigo'];
$nombre_producto = $_POST['nombre_producto'];
$descripcion = $_POST['descripcion'];
$imagen = $_POST['imagen'];
$stock = $_POST['stock'];
$stock_minimo = $_POST['stock_minimo'];
$stock_maximo = $_POST['stock_maximo'];
$precio_compra = $_POST['precio_compra'];
$precio_venta = $_POST['precio_venta'];
$fecha_de_ingreso = $_POST['fecha_de_ingreso'];

if ($_FILES['file']['name'] != null) {
    //con esto asignamos el nombre y decimos donde se guarde: public/imagenes/productos
    $archivo = date('Y-m-d-h-i-s') . $_FILES['file']['name'];
    $location = "../../../public/imagenes/productos/" . $archivo;
    move_uploaded_file($_FILES['file']['tmp_name'], $location);
    $imagen = $archivo;
}
$sql = "UPDATE tb_productos SET id_categoria='$id_categoria', codigo='$codigo', nombre_producto='$nombre_producto', descripcion='$descripcion',
imagen='$imagen', stock='$stock', stock_minimo='$stock_minimo', stock_maximo='$stock_maximo',
precio_compra='$precio_compra', precio_venta='$precio_venta', fecha_de_ingreso='$fecha_de_ingreso', fyh_actualizacion='$fyh_actualizacion'
WHERE id_producto='$id_producto'";
$query = $pdo->prepare($sql);
$query->execute();
session_start();
$_SESSION['mensaje'] = "Producto actualizado correctamente";
$_SESSION['icono'] = "success";
header("Location:" . $VIEWS . '/productos');
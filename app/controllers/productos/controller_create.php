<?php

include('../../config.php');

$id_usuario = $_POST['id_usuario'];
$id_categoria = $_POST['id_categoria'];
$codigo = $_POST['codigo'];
$nombre_producto = $_POST['nombre_producto'];
$descripcion = $_POST['descripcion'];
//con esto asignamos el nombre y decimos donde se guarde: public/imagenes/productos
$imagen = date('Y-m-d-h-i-s') . $_FILES['file']['name'];
$location = "../../../public/imagenes/productos/" . $imagen;
move_uploaded_file($_FILES['file']['tmp_name'], $location);
$stock = $_POST['stock'];
$stock_minimo = $_POST['stock_minimo'];
$stock_maximo = $_POST['stock_maximo'];
$precio_compra = $_POST['precio_compra'];
$precio_venta = $_POST['precio_venta'];
$fecha_de_ingreso = $_POST['fecha_de_ingreso'];

$sql = "INSERT INTO tb_productos(id_usuario,id_categoria, codigo,nombre_producto,descripcion,imagen,stock,
stock_minimo,stock_maximo,precio_compra,precio_venta,fecha_de_ingreso, fyh_creacion) VALUES('$id_usuario',
'$id_categoria', '$codigo', '$nombre_producto', '$descripcion', '$imagen', '$stock', '$stock_minimo', '$stock_maximo',
'$precio_compra', '$precio_venta', '$fecha_de_ingreso', '$fyh_creacion')";
$query = $pdo->prepare($sql);

if($query->execute()){
    session_start();
    $_SESSION["mensaje"] = "Producto creado correctamente";
    $_SESSION["icono"] = "success";
    header("Location:" . $VIEWS . "/productos");
}


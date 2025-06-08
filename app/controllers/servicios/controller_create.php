<?php

include('../../config.php');

$nombre_servicio = $_POST['nombre_servicio'];
$precio = $_POST['precio'];
$acumula_puntos = $_POST['acumula_puntos'];
$descripcion = $_POST['descripcion'];
//con esto asignamos el nombre y decimos donde se guarde: public/imagenes/productos
$imagen = date('Y-m-d-h-i-s') . $_FILES['file']['name'];
$location = "../../../public/imagenes/servicios/" . $imagen;
move_uploaded_file($_FILES['file']['tmp_name'], $location);
$fyh_creacion = date('Y-m-d H:i:s');

$sql = "INSERT INTO tb_servicios(nombre_servicio,precio, acumula_puntos,descripcion,imagen,fyh_creacion) 
VALUES('$nombre_servicio','$precio', '$acumula_puntos','$descripcion','$imagen','$fyh_creacion')";
$query = $pdo->prepare($sql);
if($query->execute()){
    session_start();
    $_SESSION["mensaje"] = "Servicio creado correctamente";
    $_SESSION["icono"] = "success";
    header("Location:" . $VIEWS . "/servicios");
}


<?php

include('../../config.php');

$id_servicio = $_POST['id_servicio'];
$nombre_servicio = $_POST['nombre_servicio'];
$precio = $_POST['precio'];
$acumula_puntos = $_POST['acumula_puntos'];
$descripcion = $_POST['descripcion'];
$imagen = $_POST['imagen'];

//verificamos si la imagen viene vacia
if ($_FILES['file']['name'] != null) {
    //con esto asignamos el nombre y decimos donde se guarde: public/imagenes/servicios
    $archivo = date('Y-m-d-h-i-s') . $_FILES['file']['name'];
    $location = "../../../public/imagenes/servicios/" . $archivo;
    move_uploaded_file($_FILES['file']['tmp_name'], $location);
    $imagen = $archivo;
}

$sql = "UPDATE tb_servicios 
SET nombre_servicio='$nombre_servicio', precio='$precio', acumula_puntos='$acumula_puntos',
 descripcion='$descripcion', imagen='$imagen', fyh_actualizacion='$fyh_actualizacion' 
WHERE id_servicio='$id_servicio'";

$query = $pdo->prepare($sql);
if($query->execute()){
    session_start();
    $_SESSION['mensaje'] = "Servicio actualizado correctamente";
    $_SESSION['icono'] = "success";
    header("Location:" . $VIEWS . '/servicios');
}
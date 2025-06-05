<?php

include('../../config.php');

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$puntos_requeridos = $_POST['puntos_requeridos'];
$activo = $_POST['activo'];

// Manejo de la imagen
$imagen = date('Y-m-d-h-i-s') . $_FILES['file']['name'];
$location = "../../../public/imagenes/promociones/" . $imagen;
move_uploaded_file($_FILES['file']['tmp_name'], $location);

$fyh_creacion = date('Y-m-d H:i:s');

$sql = "INSERT INTO tb_promociones(nombre, descripcion, imagen, puntos_requeridos, activo, created_at) 
        VALUES('$nombre', '$descripcion', '$imagen', '$puntos_requeridos', '$activo', '$fyh_creacion')";

$query = $pdo->prepare($sql);

if($query->execute()){
    session_start();
    $_SESSION["mensaje"] = "Promoción creada correctamente";
    $_SESSION["icono"] = "success";
    header("Location:" . $VIEWS . "/promociones");
} else {
    session_start();
    $_SESSION["mensaje"] = "Error al crear la promoción";
    $_SESSION["icono"] = "error";
    header("Location:" . $VIEWS . "/promociones/create.php");
}

?>
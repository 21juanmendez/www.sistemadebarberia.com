<?php

include('../../config.php');

$id_promocion = $_POST['id_promocion'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$puntos_requeridos = $_POST['puntos_requeridos'];
$activo = $_POST['activo'];
$imagen = $_POST['imagen'];

// Verificamos si la imagen viene vacía
if ($_FILES['file']['name'] != null) {
    // Con esto asignamos el nombre y decimos donde se guarde: public/imagenes/promociones
    $archivo = date('Y-m-d-h-i-s') . $_FILES['file']['name'];
    $location = "../../../public/imagenes/promociones/" . $archivo;
    move_uploaded_file($_FILES['file']['tmp_name'], $location);
    $imagen = $archivo;
}

$fyh_actualizacion = date('Y-m-d H:i:s');

$sql = "UPDATE tb_promociones 
        SET nombre='$nombre', descripcion='$descripcion', puntos_requeridos='$puntos_requeridos', 
            activo='$activo', imagen='$imagen', updated_at='$fyh_actualizacion' 
        WHERE id='$id_promocion'";

$query = $pdo->prepare($sql);

if($query->execute()){
    session_start();
    $_SESSION['mensaje'] = "Promoción actualizada correctamente";
    $_SESSION['icono'] = "success";
    header("Location:" . $VIEWS . '/promociones');
} else {
    session_start();
    $_SESSION['mensaje'] = "Error al actualizar la promoción";
    $_SESSION['icono'] = "error";
    header("Location:" . $VIEWS . '/promociones/update.php?id=' . $id_promocion);
}

?>
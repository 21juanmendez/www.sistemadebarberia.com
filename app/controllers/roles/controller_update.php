<?php
include('../../config.php');
$id_rol = $_POST['id_rol'];
$nombre = $_POST['nombre'];


$sql = "UPDATE tb_roles SET nombre = '$nombre', fyh_actualizacion='$fyh_actualizacion' WHERE id_rol = $id_rol";
$query = $pdo->prepare($sql);
$query->execute();

if ($query->execute()) {
    session_start();
    $_SESSION['mensaje'] = 'Rol actualizado correctamente';
    $_SESSION['icono'] = 'success';
    header('Location:' . $URL . '/views/roles/index.php');
    exit();
} else {
    session_start();
    $_SESSION['mensaje'] = 'Error al actualizar el rol';
    $_SESSION['icono'] = 'error';
    header('Location:' . $URL . '/views/roles/index.php');
    exit();
}


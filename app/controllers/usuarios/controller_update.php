<?php
include("../../config.php");

$id_usuario = $_POST['id_usuario'];
$id_rol = $_POST['id_rol'];
$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$password = $_POST['password'];
$password2 = $_POST['password2'];

if ($password == '' &&  $password2 == '') {
    $sql = "UPDATE tb_usuarios SET id_rol='$id_rol', nombre_completo='$nombre',telefono='$telefono', email='$email',
    fyh_actualizacion='$fyh_actualizacion' WHERE id_usuario='$id_usuario'";
    $query = $pdo->prepare($sql);
    $query->execute();
    session_start();
    $_SESSION['mensaje'] = "Usuario actualizado correctamente";
    $_SESSION["icono"] = "success";
    header("Location:" . $VIEWS . "/usuarios/usuarios.php");
} elseif (($password == $password2) && ($password != "" && $password2 != "")) {

    $encriptada = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE tb_usuarios SET id_rol='$id_rol', nombre_completo='$nombre',telefono='$telefono', email='$email', password='$encriptada',
    fyh_actualizacion='$fyh_actualizacion' WHERE id_usuario='$id_usuario'";
    $query = $pdo->prepare($sql);
    $query->execute();
    session_start();
    $_SESSION['mensaje'] = "Usuario actualizado correctamente bucle de no vacio";
    $_SESSION["icono"] = "success";
    header("Location:" . $VIEWS . "/usuarios/usuarios.php");
} else {
    session_start();
    $_SESSION['mensaje'] = 'Las contraseñas no coinciden';
    $_SESSION['icono'] = 'error';
    header("Location:" . $VIEWS . "/usuarios/update.php?id_usuario=$id_usuario");
}

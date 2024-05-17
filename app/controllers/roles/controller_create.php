<?php
include('../../config.php');

$rol = $_POST['nombre'];

$sql = "SELECT * FROM tb_roles WHERE nombre='$rol'";
$query=$pdo->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

if($result){
    session_start();
    $_SESSION['mensaje'] = 'El rol ya existe, intente con otro nombre';
    $_SESSION['icono'] = 'error';
    header('Location:'.$VIEWS.'/roles/create.php');
}else{
    $sql = "INSERT INTO tb_roles (nombre, fyh_creacion) VALUES ('$rol', '$fyh_creacion')";
    $query=$pdo->prepare($sql);
    $query->execute();
    $query->fetchAll(PDO::FETCH_ASSOC);
    session_start();
    $_SESSION['mensaje'] = 'Rol creado correctamente';
    $_SESSION['icono'] = 'success';
    header('Location:'.$VIEWS.'/roles/index.php');
}

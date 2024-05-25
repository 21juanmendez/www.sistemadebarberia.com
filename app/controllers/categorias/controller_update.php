<?php
include(../../config.php);


$id_categoria = $POST['id_categoria'];
$nombre = $POST['nombre'];

$sql = "UPDATE tb_categorias SET nombre = '$nombre', fyh_creacion='$fyh_actualizacion' WHERE id_categoria=$id_categoria";
$query=$pdo->prepare($sql);

if($query->execute()){
    session_start();
    $_SESSION['mensaje']='Categoria actualizada correctamente';
    $_SESSION['icono']='success';
    header('location:'.$URL.'/views/categorias');
}else{
    session_start();
    $_SESSION['mensaje']='Error al alctualizar la categoria';
    $_SESSION['icono']='error';
        header('location:'.$URL."/views/categorias/update.php?id_categoria=$id_categoria");
}

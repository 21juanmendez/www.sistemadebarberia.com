<?php
include('../../config.php');

$nombre = $_POST['nombre'];

$sql = "INSERT INTO tb_categorias (nombre, fyh_creacion) VALUES ('$nombre', '$fyh_creacion')";
$query = $pdo->prepare($sql);

if ($query->execute()){
    session_start();
    $_SESSION['mensaje']="Categoria registrada con exito";
    $_SESSION['icono']="success";
    header('Location: ' . $VIEWS . '/categorias');
}else{
    echo "Error al registrar";
}
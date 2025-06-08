<?php

include('../../config.php');

$id_categoria_gasto = $_POST['id_categoria_gasto'];
$descripcion = $_POST['descripcion'];
$monto = $_POST['monto'];
$fecha_gasto = $_POST['fecha_gasto'];

$sql = "INSERT INTO tb_gastos(id_categoria_gasto, descripcion, monto, fecha_gasto, fyh_creacion) 
        VALUES('$id_categoria_gasto', '$descripcion', '$monto', '$fecha_gasto', '$fyh_creacion')";
$query = $pdo->prepare($sql);

if($query->execute()){
    session_start();
    $_SESSION["mensaje"] = "Gasto registrado correctamente";
    $_SESSION["icono"] = "success";
    header("Location:" . $VIEWS . "/gastos");
} else {
    session_start();
    $_SESSION["mensaje"] = "Error al registrar el gasto";
    $_SESSION["icono"] = "error";
    header("Location:" . $VIEWS . "/gastos/create.php");
}

?>
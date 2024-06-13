<?php
include("../../config.php");

$id_empleado = $_POST['id_empleado'];

$sql = "DELETE FROM tb_empleados WHERE id_empleado = $id_empleado";
$query=$pdo->prepare($sql);
if($query->execute()){
    session_start();
    $_SESSION["mensaje"] = "Empleado eliminado correctamente";
    $_SESSION["icono"] = "success";
    header("Location:". $VIEWS."/empleados/index.php");
}
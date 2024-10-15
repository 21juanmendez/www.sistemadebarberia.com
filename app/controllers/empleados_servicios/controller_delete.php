<?php

include('../../config.php');
$id_empleado= $_POST['id_empleado'];
$id_empleado_servicio = $_POST['id_empleado_servicio'];

$sql = "DELETE FROM tb_empleado_servicio WHERE id_empleado_servicio = $id_empleado_servicio";
$query = $pdo->prepare($sql);
if ($query->execute()) {
    session_start();
    $_SESSION["mensaje"] = "Servicio eliminado correctamente";
    $_SESSION["icono"] = "success";
    header('Location:' . $VIEWS . '/empleados_servicios/create.php?id_empleado=' . $id_empleado);
}

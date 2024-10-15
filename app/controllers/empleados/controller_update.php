<?php
include("../../config.php");
$id_empleado = "$_POST[id_empleado]";
$name = "$_POST[name]";
$email = "$_POST[email]";
$direccion = "$_POST[direccion]";
$telefono = "$_POST[telefono]";
$dui = $_POST['dui'];
// Eliminar el guion del número de DUI si está presente
$dui = str_replace('-', '', $dui);
$nit = $_POST['nit'];
// Eliminar los guiones del NIT si están presentes
$nit = str_replace('-', '', $nit);


$sql = "UPDATE tb_empleados SET nombre_empleado='$name', email='$email', direccion='$direccion',
telefono='$telefono', dui='$dui', nit='$nit', fyh_actualizacion='$fyh_actualizacion'
WHERE id_empleado='$id_empleado'";
$query = $pdo->prepare($sql);
if ($query->execute()) {
    session_start();
    $_SESSION["mensaje"] = "El empleado ha sido actualizado correctamente";
    $_SESSION["icono"] = "success";
    header("Location:" . $VIEWS . "/empleados/index.php");
}

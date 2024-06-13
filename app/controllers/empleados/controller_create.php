<?php
include("../../config.php");

$nombre = $_POST['name'];
$email = $_POST['email'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$dui = $_POST['dui'];
// Eliminar el guion del número de DUI si está presente
$dui = str_replace('-', '', $dui);
$nit = $_POST['nit'];
// Eliminar los guiones del NIT si están presentes
$nit = str_replace('-', '', $nit);

// Verificar si ya existe un empleado con el mismo DUI o NIT
$verify_dui = $pdo->prepare("SELECT * FROM tb_empleados WHERE dui = :dui OR nit = :nit");
$verify_dui->execute(array(':dui' => $dui, ':nit' => $nit));
$existing_employee = $verify_dui->fetch();

session_start();
if ($existing_employee) {
    $_SESSION["mensaje"] = "Ya existe un empleado con el mismo DUI o NIT.";
    $_SESSION["icono"] = "error";
    header("Location:" . $VIEWS . "/empleados/create.php");
    exit; // Detener la ejecución del script para evitar la inserción duplicada
}

// Si no hay empleado con el mismo DUI o NIT, proceder con la inserción
$sql = "INSERT INTO tb_empleados (nombre_empleado, email, direccion, telefono, dui, nit, fyh_creacion) 
VALUES ('$nombre', '$email', '$direccion', '$telefono', '$dui', '$nit', '$fyh_creacion')";
$query = $pdo->prepare($sql);

if ($query->execute()) {
    $_SESSION["mensaje"] = "Empleado creado correctamente";
    $_SESSION["icono"] = "success";
    header("Location:" . $VIEWS . "/empleados/index.php");
}else{
    $_SESSION["mensaje"] = "Error al crear el empleado.";
    $_SESSION["icono"] = "error";
    header("Location:" . $VIEWS . "/empleados/index.php");
}



<?php
//Aqui solo guardamos en variables los datos del empleado seleccionado por el usuario
$id_empleado = "$_GET[id_empleado]";

$sql = "SELECT * FROM tb_empleados WHERE id_empleado = $id_empleado";
$query = $pdo->query($sql);
$query->execute();
$empleados = $query->fetchAll();

foreach ($empleados as $empleado) {
    $id_empleado = $empleado['id_empleado'];
    $nombre_empleado = $empleado['nombre_empleado'];
    $telefono = $empleado['telefono'];
    $email = $empleado['email'];
    $dui = $empleado['dui'];
    $nit = $empleado['nit'];
    $direccion = $empleado['direccion'];
    $fyh_creacion = $empleado['fyh_creacion'];
    $fyh_actualizacion = $empleado['fyh_actualizacion'];
}

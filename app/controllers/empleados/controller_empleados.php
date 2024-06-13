<?php
//Traemos todos los datos de la tabla y muestra el total de empleados
$sql = "SELECT * FROM tb_empleados";

$query = $pdo->query($sql);
$query->execute();
$empleados = $query->fetchAll(PDO::FETCH_ASSOC);

$contadorEmpleados = 0;
foreach( $empleados as $empleado ){
    $contadorEmpleados++;
}

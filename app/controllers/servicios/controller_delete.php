<?php

include('../../config.php');

$id_servicio = $_POST['id_servicio'];

// Verificar si el servicio está siendo utilizado por algún empleado
$sql_check = "SELECT COUNT(*) AS empleado_count FROM tb_empleado_servicio WHERE id_servicio = '$id_servicio'";
$query_check = $pdo->query($sql_check);
$result_check = $query_check->fetch(PDO::FETCH_ASSOC);

if ($result_check['empleado_count'] > 0) {
    session_start();
    $_SESSION['mensaje'] = 'No se puede eliminar el servicio porque está siendo utilizado por empleados';
    $_SESSION['icono'] = 'warning';
    header('Location:' . $URL . '/views/servicios/index.php');
    exit();
}

//verificamos si el servicio esta asociado a una venta
$consulta = "SELECT COUNT(*) AS cantidadserv FROM tb_ventas_servicio WHERE id_servicio = $id_servicio";
$query1 = $pdo->prepare($consulta);
$query1->execute();
$resultado = $query1->fetch(PDO::FETCH_ASSOC);

if ($resultado['cantidadserv'] > 0) {
    session_start();
    $_SESSION['mensaje'] = 'No se puede eliminar el servicio porque está siendo utilizado en ventas';
    $_SESSION['icono'] = 'warning';
    header('Location:' . $URL . '/views/servicios/index.php');
    exit();
}

// Si no hay empleados utilizando el servicio, se puede eliminar
$sql_delete = "DELETE FROM tb_servicios WHERE id_servicio = '$id_servicio'";
$query_delete = $pdo->prepare($sql_delete);

if ($query_delete->execute()) {
    session_start();
    $_SESSION['mensaje'] = 'Servicio eliminado correctamente';
    $_SESSION['icono'] = 'success';
    header('Location:' . $URL . '/views/servicios/index.php');
    exit();
} else {
    // Manejar el caso en el que la eliminación falle por alguna razón
    echo "Error al eliminar el servicio.";
}

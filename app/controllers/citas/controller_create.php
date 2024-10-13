<?php

include('../../config.php');

$id_servicio = $_POST['id_servicio'];
$id_usuario = $_POST['id_usuario'];
$fecha_cita = $_POST['fecha_cita'];
$hora_cita = $_POST['hora_cita'];
$start = $fecha_cita;
$end = $fecha_cita;
$color = "#FF0000";
$fyh_creacion = date("Y-m-d H:i:s");

// Validación para no permitir fechas anteriores a hoy
$fecha_actual = date("Y-m-d");

if ($fecha_cita < $fecha_actual) {
    // Si la fecha de la cita es anterior a la actual, redirigimos con un mensaje de error
    session_start();
    $_SESSION['mensaje'] = "No se pueden reservar citas en días anteriores";
    $_SESSION['icono'] = "error";
    header('Location:' . $URL . '/registrar_cita.php');
    exit();
}

// Validamos si ya existe una cita en la misma fecha y hora
$seql_check = "SELECT * FROM tb_cita WHERE fecha_cita = :fecha_cita AND hora_cita = :hora_cita";
$query_check = $pdo->prepare($seql_check);
$query_check->bindParam(':fecha_cita', $fecha_cita);
$query_check->bindParam(':hora_cita', $hora_cita);
$query_check->execute();
$cita_existente = $query_check->fetch(PDO::FETCH_ASSOC);

if ($cita_existente) {
    // Si existe una cita, redirigir con un mensaje de error
    session_start();
    $_SESSION['mensaje'] = "Ya existe una cita en esa fecha y hora";
    $_SESSION['icono'] = "warning";
    header('Location:' . $URL . '/registrar_cita.php');
} else {
    // Si no existe cita, seguimos con la inserción
    $seql1 = "SELECT * FROM tb_servicios WHERE id_servicio = :id_servicio";
    $query = $pdo->prepare($seql1);
    $query->bindParam(':id_servicio', $id_servicio);
    $query->execute();
    $datos1 = $query->fetch(PDO::FETCH_ASSOC);
    $title = $datos1['nombre_servicio']; // Asignamos el nombre del servicio a la variable $title

    // Insertamos los datos en la tabla tb_cita
    $seql = "INSERT INTO tb_cita (id_usuario, id_servicio, fecha_cita, hora_cita, title, start, end, color, fyh_creacion)
             VALUES (:id_usuario, :id_servicio, :fecha_cita, :hora_cita, :title, :start, :end, :color, :fyh_creacion)";
    $query = $pdo->prepare($seql);
    $query->bindParam(':id_usuario', $id_usuario);
    $query->bindParam(':id_servicio', $id_servicio);
    $query->bindParam(':fecha_cita', $fecha_cita);
    $query->bindParam(':hora_cita', $hora_cita);
    $query->bindParam(':title', $title);
    $query->bindParam(':start', $start);
    $query->bindParam(':end', $end);
    $query->bindParam(':color', $color);
    $query->bindParam(':fyh_creacion', $fyh_creacion);
    $consulta = $query->execute();

    if ($consulta) {
        session_start();
        $_SESSION['mensaje'] = "Cita creada correctamente";
        $_SESSION['icono'] = "success";
        header('Location:' . $URL . '/registrar_cita.php');
    } else {
        session_start();
        $_SESSION['mensaje'] = "Error al crear la cita";
        $_SESSION['icono'] = "error";
        header('Location:' . $URL . '/registrar_cita.php');
    }
}

<?php
include('../../config.php');

// Si recibimos una fecha específica, devolvemos solo las horas ocupadas para esa fecha
if (isset($_GET['fecha'])) {
    $fecha_cita = $_GET['fecha'];
    
    // Consulta para obtener las horas ocupadas en la fecha seleccionada
    $seql = "SELECT hora_cita FROM tb_cita WHERE fecha_cita = :fecha_cita";
    $query = $pdo->prepare($seql);
    $query->bindParam(':fecha_cita', $fecha_cita);
    $query->execute();
    $horas_ocupadas = $query->fetchAll(PDO::FETCH_COLUMN);
    
    // Devolvemos las horas ocupadas en formato JSON
    echo json_encode($horas_ocupadas);

// Si no recibimos una fecha específica, devolvemos las citas para mostrarlas en el calendario
} else {
    // Consulta para obtener todas las citas
    $seql = "SELECT id_cita AS id, title AS title, fecha_cita AS start, fecha_cita AS end, color AS color FROM tb_cita";
    $query = $pdo->prepare($seql);
    $query->execute();
    $citas = $query->fetchAll(PDO::FETCH_ASSOC);

    // Devolvemos las citas en formato JSON para FullCalendar
    echo json_encode($citas);
}

<?php


$id_cita = $_GET['id_cita'];

$sql="SELECT c.*, u.nombre_completo, r.nombre, s.nombre_servicio FROM tb_cita c
INNER JOIN tb_usuarios u ON c.id_usuario = u.id_usuario
INNER JOIN tb_roles r ON u.id_rol = r.id_rol
INNER JOIN tb_servicios s ON c.id_servicio = s.id_servicio
WHERE c.id_cita = $id_cita";


$query = $pdo->prepare($sql);
$query->execute();
$citas = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($citas as $cita) {
    $id_cita = $cita['id_cita'];
    $rol= $cita['nombre'];
    $nombre_completo = $cita['nombre_completo'];
    $nombre_servicio = $cita['nombre_servicio'];
    $fecha_cita = $cita['fecha_cita'];
    $hora_cita = $cita['hora_cita'];
    $fyh_creacion = $cita['fyh_creacion'];
}
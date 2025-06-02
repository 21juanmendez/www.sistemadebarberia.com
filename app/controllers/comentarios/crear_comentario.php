<?php
session_start();
include('../../config.php');

if (!isset($_SESSION['cliente']) && !isset($_SESSION['admin'])) {
    $_SESSION['titulo'] = 'Acceso denegado';
    $_SESSION['mensajeComentario'] = 'Debes iniciar sesión para publicar un comentario';
    $_SESSION['icono'] = 'warning';
    header('Location: ' . $URL . "/index.php");
    exit;
}

$id_usuario = $_SESSION['id_usuario'];
$id_servicio = isset($_POST['id_servicio']) ? intval($_POST['id_servicio']) : 0;
$titulo = trim($_POST['titulo']);
$comentario = trim($_POST['comentario']);
$calificacion = intval($_POST['calificacion']);

// Validación
if ($id_servicio <= 0 || $titulo === '' || $comentario === '' || $calificacion < 1 || $calificacion > 5) {
    $_SESSION['mensaje'] = 'Por favor completa todos los campos correctamente';
    $_SESSION['icono'] = 'error';
    header('Location: ' . $URL . "/index.php");
    exit;
}

try {
    $sql = "INSERT INTO tb_comentarios (id_usuario, id_servicio, titulo, comentario, calificacion) VALUES (?, ?, ?, ?, ?)";
    $query = $pdo->prepare($sql);
    $query->execute([$id_usuario, $id_servicio, $titulo, $comentario, $calificacion]);

    $_SESSION['titulo'] = 'Comentario publicado';
    $_SESSION['mensajeComentario'] = 'Tu comentario ha sido publicado exitosamente';
    $_SESSION['icono'] = 'success';
    header('Location: ' . $URL . "/index.php");
    exit;
} catch (PDOException $e) {
    echo "Error al guardar el comentario: " . $e->getMessage();
    exit;
}

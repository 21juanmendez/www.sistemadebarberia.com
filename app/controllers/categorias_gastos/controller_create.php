<?php
// app/controllers/categorias_gastos/create.php
include('../../config.php');

$nombre = $_POST['nombre'];
$fyh_creacion = date('Y-m-d H:i:s');

// Verificar si ya existe una categoría con ese nombre
$sql_verificar = "SELECT * FROM tb_categorias_gastos WHERE nombre = :nombre";
$query_verificar = $pdo->prepare($sql_verificar);
$query_verificar->bindParam(':nombre', $nombre);
$query_verificar->execute();

if ($query_verificar->rowCount() > 0) {
    session_start();
    $_SESSION['mensaje'] = "Ya existe una categoría con ese nombre";
    $_SESSION['icono'] = "error";
    header('Location: ' . $VIEWS . '/categorias_gastos/create.php');
    exit();
}

// Insertar la nueva categoría
$sql = "INSERT INTO tb_categorias_gastos (nombre, fyh_creacion) VALUES (:nombre, :fyh_creacion)";
$query = $pdo->prepare($sql);
$query->bindParam(':nombre', $nombre);
$query->bindParam(':fyh_creacion', $fyh_creacion);

if ($query->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Categoría registrada exitosamente";
    $_SESSION['icono'] = "success";
    header('Location: ' . $VIEWS . '/categorias_gastos/');
} else {
    session_start();
    $_SESSION['mensaje'] = "Error al registrar la categoría";
    $_SESSION['icono'] = "error";
    header('Location: ' . $VIEWS . '/categorias_gastos/create.php');
}
?>
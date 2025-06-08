<?php
// app/controllers/categorias_gastos/update.php
include('../../config.php');

$id_categoria_gasto = $_POST['id_categoria_gasto'];
$nombre = $_POST['nombre'];
$fyh_actualizacion = date('Y-m-d H:i:s');

// Verificar si ya existe otra categoría con ese nombre (excluyendo la actual)
$sql_verificar = "SELECT * FROM tb_categorias_gastos WHERE nombre = :nombre AND id_categoria_gasto != :id_categoria_gasto";
$query_verificar = $pdo->prepare($sql_verificar);
$query_verificar->bindParam(':nombre', $nombre);
$query_verificar->bindParam(':id_categoria_gasto', $id_categoria_gasto);
$query_verificar->execute();

if ($query_verificar->rowCount() > 0) {
    session_start();
    $_SESSION['mensaje'] = "Ya existe otra categoría con ese nombre";
    $_SESSION['icono'] = "error";
    header('Location: ' . $VIEWS . '/categorias_gastos/update.php?id_categoria_gasto=' . $id_categoria_gasto);
    exit();
}

// Actualizar la categoría
$sql = "UPDATE tb_categorias_gastos SET nombre = :nombre, fyh_actualizacion = :fyh_actualizacion WHERE id_categoria_gasto = :id_categoria_gasto";
$query = $pdo->prepare($sql);
$query->bindParam(':nombre', $nombre);
$query->bindParam(':fyh_actualizacion', $fyh_actualizacion);
$query->bindParam(':id_categoria_gasto', $id_categoria_gasto);

if ($query->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Categoría actualizada exitosamente";
    $_SESSION['icono'] = "success";
    header('Location: ' . $VIEWS . '/categorias_gastos/');
} else {
    session_start();
    $_SESSION['mensaje'] = "Error al actualizar la categoría";
    $_SESSION['icono'] = "error";
    header('Location: ' . $VIEWS . '/categorias_gastos/update.php?id_categoria_gasto=' . $id_categoria_gasto);
}
?>
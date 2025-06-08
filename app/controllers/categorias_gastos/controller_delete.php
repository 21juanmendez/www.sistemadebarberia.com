<?php
// app/controllers/categorias_gastos/delete.php
include('../../config.php');

$id_categoria_gasto = $_POST['id_categoria_gasto'];

// Verificar si la categoría existe antes de eliminar
$sql_verificar = "SELECT * FROM tb_categorias_gastos WHERE id_categoria_gasto = :id_categoria_gasto";
$query_verificar = $pdo->prepare($sql_verificar);
$query_verificar->bindParam(':id_categoria_gasto', $id_categoria_gasto);
$query_verificar->execute();

if ($query_verificar->rowCount() == 0) {
    session_start();
    $_SESSION['mensaje'] = "La categoría no existe";
    $_SESSION['icono'] = "error";
    header('Location: ' . $VIEWS . '/categorias_gastos/');
    exit();
}

$sql_verificar_uso = "SELECT COUNT(*) as total FROM tb_gastos WHERE id_categoria_gasto = :id_categoria_gasto";
$query_verificar_uso = $pdo->prepare($sql_verificar_uso);
$query_verificar_uso->bindParam(':id_categoria_gasto', $id_categoria_gasto);
$query_verificar_uso->execute();
$resultado_uso = $query_verificar_uso->fetch(PDO::FETCH_ASSOC);

if ($resultado_uso['total'] > 0) {
    session_start();
    $_SESSION['mensaje'] = "No se puede eliminar la categoría porque está siendo utilizada en " . $resultado_uso['total'] . " gasto(s)";
    $_SESSION['icono'] = "error";
    header('Location: ' . $VIEWS . '/categorias_gastos/');
    exit();
}

// Eliminar la categoría
$sql = "DELETE FROM tb_categorias_gastos WHERE id_categoria_gasto = :id_categoria_gasto";
$query = $pdo->prepare($sql);
$query->bindParam(':id_categoria_gasto', $id_categoria_gasto);

if ($query->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Categoría eliminada exitosamente";
    $_SESSION['icono'] = "success";
    header('Location: ' . $VIEWS . '/categorias_gastos/');
} else {
    session_start();
    $_SESSION['mensaje'] = "Error al eliminar la categoría";
    $_SESSION['icono'] = "error";
    header('Location: ' . $VIEWS . '/categorias_gastos/');
}
?>
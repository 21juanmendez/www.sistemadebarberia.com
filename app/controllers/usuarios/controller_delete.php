<?php
include("../../config.php");
$id_usuario = $_POST['id_usuario'];

// Verificar si hay productos asociados al usuario
$sql_verificar_productos = "SELECT COUNT(*) AS total_productos FROM tb_productos WHERE id_usuario = :id_usuario";
$query_verificar_productos = $pdo->prepare($sql_verificar_productos);
$query_verificar_productos->bindParam(':id_usuario', $id_usuario);
$query_verificar_productos->execute();
$resultado_verificar_productos = $query_verificar_productos->fetch(PDO::FETCH_ASSOC);

if ($resultado_verificar_productos['total_productos'] > 0) {
    session_start();
    $_SESSION['mensaje'] = 'No se puede eliminar el usuario porque tiene productos asociados.';
    $_SESSION['icono'] = 'error';
    header('Location:' . $VIEWS . '/usuarios/usuarios.php');
    exit();
}

// Verificar si hay ventas asociadas al usuario
$sql_verificar_ventas = "SELECT COUNT(*) AS total_ventas FROM tb_ventas WHERE id_usuario = :id_usuario";
$query_verificar_ventas = $pdo->prepare($sql_verificar_ventas);
$query_verificar_ventas->bindParam(':id_usuario', $id_usuario);
$query_verificar_ventas->execute();
$resultado_verificar_ventas = $query_verificar_ventas->fetch(PDO::FETCH_ASSOC);

if ($resultado_verificar_ventas['total_ventas'] > 0) {
    session_start();
    $_SESSION['mensaje'] = 'No se puede eliminar el usuario porque tiene ventas asociadas.';
    $_SESSION['icono'] = 'error';
    header('Location:' . $VIEWS . '/usuarios/usuarios.php');
    exit();
}

// Si no hay productos ni ventas asociados, proceder con la eliminación del usuario
$sql = "DELETE FROM tb_usuarios WHERE id_usuario = :id_usuario";
$query = $pdo->prepare($sql);
$query->bindParam(':id_usuario', $id_usuario);
$query->execute();

if ($query->rowCount() > 0) {
    session_start();
    $_SESSION['mensaje'] = 'Usuario eliminado correctamente';
    $_SESSION['icono'] = 'success';
    header('Location:' . $VIEWS . '/usuarios/usuarios.php');
} else {
    session_start();
    $_SESSION['mensaje'] = 'Error al eliminar el usuario';
    $_SESSION['icono'] = 'error';
    header('Location:' . $VIEWS . '/usuarios/usuarios.php?id_usuario=' . $id_usuario);
}
?>

<?php

include('../../config.php');

$id_promocion = $_POST['id_promocion'];

// Si no hay dependencias, se puede eliminar la promoción
$sql_delete = "DELETE FROM tb_promociones WHERE id = '$id_promocion'";
$query_delete = $pdo->prepare($sql_delete);

if ($query_delete->execute()) {
    session_start();
    $_SESSION['mensaje'] = 'Promoción eliminada correctamente';
    $_SESSION['icono'] = 'success';
    header('Location:' . $VIEWS . '/promociones');
    exit();
} else {
    session_start();
    $_SESSION['mensaje'] = 'Error al eliminar la promoción';
    $_SESSION['icono'] = 'error';
    header('Location:' . $VIEWS . '/promociones');
    exit();
}

?>
<?php
include('../../config.php');

$id_gasto = $_POST['id_gasto'];

$sql = "DELETE FROM tb_gastos WHERE id_gasto = $id_gasto";
$query = $pdo->prepare($sql);

if($query->execute()){
    session_start();
    $_SESSION['mensaje'] = 'Gasto eliminado correctamente';
    $_SESSION['icono'] = 'success';
    header('Location:' . $VIEWS . '/gastos');
} else {
    session_start();
    $_SESSION['mensaje'] = 'Error al eliminar el gasto';
    $_SESSION['icono'] = 'error';
    header('Location:' . $VIEWS . '/gastos');
}

?>
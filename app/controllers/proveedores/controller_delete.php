<?php
include('../../config.php');

$id_proveedor = $_GET['id_proveedor'];

// Verificar si el proveedor tiene compras asociadas
$sql_check = "SELECT COUNT(*) as total_compras FROM tb_compras WHERE id_proveedor = :id_proveedor";
$query_check = $pdo->prepare($sql_check);
$query_check->bindParam(':id_proveedor', $id_proveedor);
$query_check->execute();
$result = $query_check->fetch(PDO::FETCH_ASSOC);

if ($result['total_compras'] > 0) {
    // El proveedor tiene compras asociadas, no se puede eliminar
    session_start();
    $_SESSION['mensaje'] = "No se puede eliminar el proveedor porque tiene " . $result['total_compras'] . " compra(s) asociada(s)";
    $_SESSION['icono'] = 'warning';
} else {
    // No tiene compras, proceder con la eliminación
    $sql_delete = "DELETE FROM tb_proveedores WHERE id_proveedor = :id_proveedor";
    $query_delete = $pdo->prepare($sql_delete);
    $query_delete->bindParam(':id_proveedor', $id_proveedor);
    
    if ($query_delete->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Proveedor eliminado correctamente";
        $_SESSION['icono'] = 'success';
    } else {
        session_start();
        $_SESSION['mensaje'] = "Error al eliminar el proveedor";
        $_SESSION['icono'] = 'error';
    }
}

header('Location: ' . $VIEWS . '/proveedores/');
exit;
?>
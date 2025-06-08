<?php
include("../../config.php");

if ($_POST) {
    $id_compra = $_POST['id_compra'];
    $estado_nuevo = $_POST['estado'];
    $estado_anterior = $_POST['estado_anterior'];
    
    // Validar que el estado anterior sea "pendiente"
    if ($estado_anterior !== 'pendiente') {
        session_start();
        $_SESSION['mensaje'] = "Solo se pueden modificar compras en estado pendiente";
        $_SESSION['tipo_mensaje'] = "error";
        header('Location: ' . $URL . '/views/compras/');
        exit();
    }
    
    try {
        // Iniciar transacción
        $pdo->beginTransaction();
        
        // Actualizar solo el estado de la compra
        $sql_actualizar_compra = "UPDATE tb_compras SET estado = :estado WHERE id_compra = :id_compra";
        $query_actualizar_compra = $pdo->prepare($sql_actualizar_compra);
        $query_actualizar_compra->bindParam(':estado', $estado_nuevo);
        $query_actualizar_compra->bindParam(':id_compra', $id_compra);
        $query_actualizar_compra->execute();
        
        // Solo actualizar stock si el estado cambia a "completada"
        if ($estado_nuevo == 'completada') {
            // Obtener detalles de la compra para actualizar stock
            $sql_detalles = "SELECT dc.id_producto, dc.cantidad 
                            FROM tb_detalle_compras dc
                            WHERE dc.id_compra = :id_compra";
            $query_detalles = $pdo->prepare($sql_detalles);
            $query_detalles->bindParam(':id_compra', $id_compra);
            $query_detalles->execute();
            $detalles = $query_detalles->fetchAll(PDO::FETCH_ASSOC);
            
            // Actualizar stock de cada producto
            foreach ($detalles as $detalle) {
                $sql_actualizar_stock = "UPDATE tb_productos SET stock = stock + :cantidad WHERE id_producto = :id_producto";
                $query_actualizar_stock = $pdo->prepare($sql_actualizar_stock);
                $query_actualizar_stock->bindParam(':cantidad', $detalle['cantidad']);
                $query_actualizar_stock->bindParam(':id_producto', $detalle['id_producto']);
                $query_actualizar_stock->execute();
            }
        }
        
        // Confirmar transacción
        $pdo->commit();
        
        // Mensaje personalizado según el estado
        $mensaje = "Estado de compra actualizado exitosamente";
        if ($estado_nuevo == 'completada') {
            $mensaje = "Compra completada exitosamente. El stock ha sido actualizado.";
        } elseif ($estado_nuevo == 'cancelada') {
            $mensaje = "Compra cancelada exitosamente.";
        } elseif ($estado_nuevo == 'en curso') {
            $mensaje = "Compra puesta en curso exitosamente.";
        }
        
        // Redireccionar con mensaje de éxito
        session_start();
        $_SESSION['mensaje'] = $mensaje;
        $_SESSION['tipo_mensaje'] = "success";
        header('Location: ' . $URL . '/views/compras/');
        exit();
        
    } catch (Exception $e) {
        // Revertir transacción en caso de error
        $pdo->rollback();
        
        session_start();
        $_SESSION['mensaje'] = "Error al actualizar el estado de la compra: " . $e->getMessage();
        $_SESSION['tipo_mensaje'] = "error";
        header('Location: ' . $URL . '/views/compras/');
        exit();
    }
} else {
    // Si no hay datos POST, redireccionar
    header('Location: ' . $URL . '/views/compras/');
    exit();
}
?>
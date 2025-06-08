<?php
include("../../config.php");
session_start();
if ($_POST) {
    $id_proveedor = $_POST['id_proveedor'];
    $fecha_compra = $_POST['fecha_compra'];
    $productos = $_POST['productos'];
    $id_usuario = $_SESSION['id_usuario'];
    
    // Calcular total
    $total_compra = 0;
    foreach ($productos as $producto) {
        if (!empty($producto['id_producto']) && $producto['cantidad'] > 0 && $producto['precio_unitario'] > 0) {
            $total_compra += $producto['cantidad'] * $producto['precio_unitario'];
        }
    }
    
    try {
        // Iniciar transacción
        $pdo->beginTransaction();
        
        // Insertar compra
        $sql_compra = "INSERT INTO tb_compras (id_proveedor, id_usuario, fecha_compra, total_compra, estado, fyh_creacion) 
                       VALUES (:id_proveedor, :id_usuario, :fecha_compra, :total_compra, 'pendiente', NOW())";
        
        $query_compra = $pdo->prepare($sql_compra);
        $query_compra->bindParam(':id_proveedor', $id_proveedor);
        $query_compra->bindParam(':id_usuario', $id_usuario);
        $query_compra->bindParam(':fecha_compra', $fecha_compra);
        $query_compra->bindParam(':total_compra', $total_compra);
        $query_compra->execute();
        
        // Obtener ID de la compra insertada
        $id_compra = $pdo->lastInsertId();
        
        // Insertar detalles de compra
        foreach ($productos as $producto) {
            if (!empty($producto['id_producto']) && $producto['cantidad'] > 0 && $producto['precio_unitario'] > 0) {
                $subtotal = $producto['cantidad'] * $producto['precio_unitario'];
                
                $sql_detalle = "INSERT INTO tb_detalle_compras (id_compra, id_producto, cantidad, precio_unitario, subtotal, fyh_creacion) 
                               VALUES (:id_compra, :id_producto, :cantidad, :precio_unitario, :subtotal, NOW())";
                
                $query_detalle = $pdo->prepare($sql_detalle);
                $query_detalle->bindParam(':id_compra', $id_compra);
                $query_detalle->bindParam(':id_producto', $producto['id_producto']);
                $query_detalle->bindParam(':cantidad', $producto['cantidad']);
                $query_detalle->bindParam(':precio_unitario', $producto['precio_unitario']);
                $query_detalle->bindParam(':subtotal', $subtotal);
                $query_detalle->execute();
                
            }
        }
        
        // Confirmar transacción
        $pdo->commit();
        
        // Redireccionar con mensaje de éxito
        session_start();
        $_SESSION['mensaje'] = "Compra registrada exitosamente";
        $_SESSION['tipo_mensaje'] = "success";
        header('Location: ' . $URL . '/views/compras/');
        exit();
        
    } catch (Exception $e) {
        // Revertir transacción en caso de error
        $pdo->rollback();
        
        session_start();
        $_SESSION['mensaje'] = "Error al registrar la compra: " . $e->getMessage();
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
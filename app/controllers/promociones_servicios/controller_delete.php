<?php
// app/controllers/promociones_servicios/controller_delete.php

include('../../../app/config/config.php');

if ($_POST) {
    $id_promocion = $_POST['id_promocion'];
    $id_servicio = $_POST['id_servicio'];
    
    try {
        $pdo->beginTransaction();
        
        // Eliminar la relación promoción-servicio
        $sql = "DELETE FROM tb_promociones_servicios WHERE id_promocion = :id_promocion AND id_servicio = :id_servicio";
        $query = $pdo->prepare($sql);
        $query->bindParam(':id_promocion', $id_promocion);
        $query->bindParam(':id_servicio', $id_servicio);
        $query->execute();
        
        // Verificar si quedan servicios en la promoción
        $checkSql = "SELECT COUNT(*) FROM tb_promociones_servicios WHERE id_promocion = :id_promocion";
        $checkQuery = $pdo->prepare($checkSql);
        $checkQuery->bindParam(':id_promocion', $id_promocion);
        $checkQuery->execute();
        $servicios_restantes = $checkQuery->fetchColumn();
        
        // Actualizar promo_valida según si quedan servicios o no
        $promo_valida = $servicios_restantes > 0 ? 'true' : 'false';
        $updateSql = "UPDATE tb_promociones SET promo_valida = $promo_valida WHERE id = :id_promocion";
        $updateQuery = $pdo->prepare($updateSql);
        $updateQuery->bindParam(':id_promocion', $id_promocion);
        $updateQuery->execute();
        
        $pdo->commit();
        
        session_start();
        $_SESSION['msj'] = "Servicio eliminado correctamente de la promoción";
        $_SESSION['icono'] = "success";
        header('Location: ' . $URL . '/views/promociones/add_servicios.php?id=' . $id_promocion);
        exit();
        
    } catch (Exception $e) {
        $pdo->rollBack();
        session_start();
        $_SESSION['msj'] = "Error al eliminar el servicio: " . $e->getMessage();
        $_SESSION['icono'] = "error";
        header('Location: ' . $URL . '/views/promociones/add_servicios.php?id=' . $id_promocion);
        exit();
    }
} else {
    session_start();
    $_SESSION['msj'] = "Acceso no autorizado";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/views/promociones/');
    exit();
}
?>
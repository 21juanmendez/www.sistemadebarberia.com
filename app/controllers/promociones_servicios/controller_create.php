<?php
// app/controllers/promociones_servicios/controller_create.php

include('../../config.php');

if ($_POST) {
    $id_promocion = $_POST['id_promocion'];
    $id_servicios = isset($_POST['id_servicios']) ? $_POST['id_servicios'] : [];
    
    if (!empty($id_servicios)) {
        try {
            $pdo->beginTransaction();
            
            // Insertar cada servicio seleccionado
            foreach ($id_servicios as $id_servicio) {
                // Verificar si ya existe la relación
                $checkSql = "SELECT COUNT(*) FROM tb_promociones_servicios WHERE id_promocion = :id_promocion AND id_servicio = :id_servicio";
                $checkQuery = $pdo->prepare($checkSql);
                $checkQuery->bindParam(':id_promocion', $id_promocion);
                $checkQuery->bindParam(':id_servicio', $id_servicio);
                $checkQuery->execute();
                
                if ($checkQuery->fetchColumn() == 0) {
                    // Insertar si no existe la relación
                    $sql = "INSERT INTO tb_promociones_servicios (id_promocion, id_servicio) VALUES (:id_promocion, :id_servicio)";
                    $query = $pdo->prepare($sql);
                    $query->bindParam(':id_promocion', $id_promocion);
                    $query->bindParam(':id_servicio', $id_servicio);
                    $query->execute();
                }
            }
            
            // Actualizar promo_valida a true ya que ahora tiene servicios
            $updateSql = "UPDATE tb_promociones SET promo_valida = true WHERE id = :id_promocion";
            $updateQuery = $pdo->prepare($updateSql);
            $updateQuery->bindParam(':id_promocion', $id_promocion);
            $updateQuery->execute();
            
            $pdo->commit();
            
            session_start();
            $_SESSION['msj'] = "Servicios agregados correctamente a la promoción";
            $_SESSION['icono'] = "success";
            header('Location: ' . $URL . '/views/promociones/add_servicios.php?id=' . $id_promocion);
            exit();
            
        } catch (Exception $e) {
            $pdo->rollBack();
            session_start();
            $_SESSION['msj'] = "Error al agregar servicios: " . $e->getMessage();
            $_SESSION['icono'] = "error";
            header('Location: ' . $URL . '/views/promociones/add_servicios.php?id=' . $id_promocion);
            exit();
        }
    } else {
        session_start();
        $_SESSION['msj'] = "Debe seleccionar al menos un servicio";
        $_SESSION['icono'] = "warning";
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
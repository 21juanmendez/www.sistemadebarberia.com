<?php
include('../../config.php');

try {
    $id_rol = $_POST['id_rol'];
    
    // Eliminar el rol
    $sql = "DELETE FROM tb_roles WHERE id_rol = $id_rol";
    $query = $pdo->prepare($sql);
    $query->execute();

    session_start();
    $_SESSION['mensaje'] = 'Rol eliminado correctamente';
    $_SESSION['icono'] = 'success';
    header('Location:' . $URL . '/views/roles/index.php');
    exit(); // Importante para detener la ejecución después de redireccionar
} catch (PDOException $e) {
    // Capturar la excepción de violación de clave externa
    if ($e->getCode() == '23000' && $e->errorInfo[1] == 1451) {
        session_start();
        $_SESSION['mensaje'] = 'Error al eliminar el rol. Existen usuarios asociados a este rol.';
        $_SESSION['icono'] = 'error';
        header('Location:' . $URL . '/views/roles/index.php');
        exit(); // Importante para detener la ejecución después de redireccionar
    } else {
        // Otra excepción no manejada
        throw $e;
    }
}



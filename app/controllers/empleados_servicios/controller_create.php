<?php
include('../../config.php');

$id_empleado = $_POST['id_empleado'];
$id_servicios = $_POST['id_servicios']; // Ahora es un array de servicios seleccionados

foreach ($id_servicios as $id_servicio) {
    // Verificar si el servicio ya está asociado al empleado
    $sql_check = "SELECT * FROM tb_empleado_servicio WHERE id_empleado = :id_empleado AND id_servicio = :id_servicio";
    $query_check = $pdo->prepare($sql_check);
    $query_check->bindParam(':id_empleado', $id_empleado);
    $query_check->bindParam(':id_servicio', $id_servicio);
    $query_check->execute();
    $exists = $query_check->fetch(PDO::FETCH_ASSOC);

    if (!$exists) {
        // Insertar el servicio solo si no existe
        $sql_insert = "INSERT INTO tb_empleado_servicio (id_empleado, id_servicio) VALUES (:id_empleado, :id_servicio)";
        $query_insert = $pdo->prepare($sql_insert);
        $query_insert->bindParam(':id_empleado', $id_empleado);
        $query_insert->bindParam(':id_servicio', $id_servicio);

        if ($query_insert->execute()) {
            session_start();
            $_SESSION['mensaje'] = 'Servicio(s) agregado(s) correctamente';
            $_SESSION['icono'] = 'success';
            header("Location:" . $VIEWS . "/empleados_servicios/create.php?id_empleado=".$id_empleado);
        } else {
            // Manejar errores de inserción
            echo "Error al agregar el servicio";
        }
    } else {
        // El servicio ya está asociado al empleado
        session_start();
        $_SESSION['mensaje'] = 'El servicio ya está asociado al empleado';
        $_SESSION['icono'] = 'error';
        header("Location:" . $VIEWS . "/empleados_servicios/create.php?id_empleado=".$id_empleado);
    }
}
?>

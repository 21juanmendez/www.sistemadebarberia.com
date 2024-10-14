<?php
include('../../config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_cita = $_POST['id']; // Obtenemos el ID de la cita

    // Eliminamos la cita de la base de datos
    $sql = "DELETE FROM tb_cita WHERE id_cita = :id_cita";
    $query = $pdo->prepare($sql);
    $query->bindParam(':id_cita', $id_cita, PDO::PARAM_INT);

    if ($query->execute()) {
        // Respuesta de éxito
        echo json_encode(['success' => true]);
    } else {
        // Respuesta de error
        echo json_encode(['success' => false]);
    }
}
?>

<?php
include('../../config.php');
session_start();

// Verificamos si se ha recibido un ID de cita
if (isset($_GET['id'])) {
    $id_cita = $_GET['id'];
    $response = [];

    try {
        // Primero, obtenemos el ID del usuario logueado
        $id_usuario = $_SESSION['id']; // Asegúrate de que esto esté configurado correctamente en tu sesión

        // Consulta para obtener los detalles de la cita
        $seql = "SELECT 
                c.id_cita AS id, 
                s.nombre_servicio AS servicio, 
                c.fecha_cita AS fecha, 
                c.hora_cita AS hora, 
                c.color AS color, 
                u.nombre_completo AS usuario,
                u.id_usuario AS user_id
            FROM tb_cita c
            JOIN tb_servicios s ON c.id_servicio = s.id_servicio
            JOIN tb_usuarios u ON c.id_usuario = u.id_usuario
            WHERE c.id_cita = :id_cita";

        // Preparamos la consulta
        $query = $pdo->prepare($seql);
        $query->bindParam(':id_cita', $id_cita, PDO::PARAM_INT);
        $query->execute();

        $detalle_cita = $query->fetch(PDO::FETCH_ASSOC);

        // Verificamos si se encontró la cita
        if ($detalle_cita) {
            // Comprobamos si el usuario logueado es el que creó la cita
            if ($detalle_cita['user_id'] == $id_usuario) {
                $response = $detalle_cita; // Asignamos los detalles a la respuesta
            } else {
                $response = ['error' => 'No tienes permiso para ver esta cita.']; // Mensaje de error
            }
        } else {
            $response = ['error' => 'Cita no encontrada']; // Mensaje de error si no se encontró la cita
        }
    } catch (PDOException $e) {
        $response = ['error' => 'Error en la base de datos: ' . $e->getMessage()];
    }

    // Establecer el encabezado para la respuesta JSON
    header('Content-Type: application/json');
    // Devolvemos la respuesta en formato JSON
    echo json_encode($response);
} else {
    // Mensaje de error si no se proporciona un ID
    header('Content-Type: application/json');
    echo json_encode(['error' => 'ID no proporcionado']);
}
?>

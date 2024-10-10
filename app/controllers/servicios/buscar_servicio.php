<?php
include '../../config.php';
if (isset($_POST['term'])) {
    $term = $pdo->quote('%' . $_POST['term'] . '%');  // Utilizamos quote para evitar inyecciones SQL

    // Consulta SQL para buscar servicios por nombre o código
    $sql = "SELECT id_servicio, nombre_servicio FROM tb_servicios
            WHERE nombre_servicio LIKE $term
            OR id_servicio LIKE $term
            LIMIT 10";

    $resultado = $pdo->query($sql);

    // Verificar si hay resultados
    $servicios = [];
    if ($resultado->rowCount() > 0) {
        // Recorrer los resultados y generar las sugerencias
        while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
            $servicios[] = $fila;
        }
    }
    echo json_encode($servicios);
}
?>

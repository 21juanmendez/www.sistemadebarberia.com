<?php
include '../../config.php';
if (isset($_POST['term'])) {
    $term = $pdo->quote('%' . $_POST['term'] . '%');  // Utilizamos quote para evitar inyecciones SQL

    // Consulta SQL para buscar productos por nombre o código
    $sql = "SELECT id_producto, nombre_producto FROM tb_productos 
            WHERE nombre_producto LIKE $term 
            OR id_producto LIKE $term 
            LIMIT 10";

    $resultado = $pdo->query($sql);

    // Verificar si hay resultados
    $productos = [];
    if ($resultado->rowCount() > 0) {
        // Recorrer los resultados y generar las sugerencias
        while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
            $productos[] = $fila;
        }
    }
    echo json_encode($productos);
}
?>

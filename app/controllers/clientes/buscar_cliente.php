<?php
include '../../config.php';
if (isset($_POST['term'])) {
    $term = $pdo->quote('%' . $_POST['term'] . '%');  // Utilizamos quote para evitar inyecciones SQL

    //consulta para buscar nombre de cliente
    $sql = "SELECT c.id_cliente, c.acumulado_puntos, u.nombre_completo AS nombre_cliente
            FROM tb_clientes c
            JOIN tb_usuarios u ON c.id_usuario = u.id_usuario
            WHERE u.nombre_completo LIKE $term
            LIMIT 10;";

    $resultado = $pdo->query($sql);

    // Verificar si hay resultados
    $clientes = [];
    if ($resultado->rowCount() > 0) {
        // Recorrer los resultados y generar las sugerencias
        while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
            $clientes[] = $fila;
        }
    }
    echo json_encode($clientes);
}
?>
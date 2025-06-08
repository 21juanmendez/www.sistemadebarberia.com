<?php

// Obtener lista de todas las categorías de gastos
$sql = "SELECT * FROM tb_categorias_gastos ORDER BY nombre ASC";
$query = $pdo->prepare($sql);
$query->execute();
$lista_categorias_gastos = $query->fetchAll(PDO::FETCH_ASSOC);

// Contador de categorías
$contadorCategoriasGastos = 0;
foreach ($lista_categorias_gastos as $categoria_gasto) {
    $contadorCategoriasGastos++;
}

// Función para obtener una categoría específica
if (isset($_GET['id_categoria_gasto'])) {
    $id_categoria_gasto = $_GET['id_categoria_gasto'];
    $sql_categoria = "SELECT * FROM tb_categorias_gastos WHERE id_categoria_gasto = :id_categoria_gasto";
    $query_categoria = $pdo->prepare($sql_categoria);
    $query_categoria->bindParam(':id_categoria_gasto', $id_categoria_gasto);
    $query_categoria->execute();
    $categoria_gasto = $query_categoria->fetch(PDO::FETCH_ASSOC);
}
?>
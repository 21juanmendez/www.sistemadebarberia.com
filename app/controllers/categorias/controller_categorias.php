<?php

$sql = "SELECT * FROM tb_categorias";
$query = $pdo->prepare($sql);
$query->execute();
$lista_categorias = $query->fetchAll(PDO::FETCH_ASSOC);

$contadorCategorias = 0;
foreach ($lista_categorias as $categoria) {
    $contadorCategorias++;
}


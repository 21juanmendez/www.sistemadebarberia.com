<?php


$sql = "SELECT p.*, c.nombre 
FROM tb_productos p 
INNER JOIN tb_categorias c 
ON p.id_categoria = c.id_categoria 
ORDER BY c.nombre;";

$query = $pdo->prepare($sql);
$query->execute();
$productos = $query->fetchAll(PDO::FETCH_ASSOC);

$contadorProductos = 0;
foreach ($productos as $producto) {
    $contadorProductos++;
}

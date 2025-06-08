<?php

$sql = "SELECT g.*, c.nombre as categoria
FROM tb_gastos g 
INNER JOIN tb_categorias_gastos c 
ON g.id_categoria_gasto = c.id_categoria_gasto 
ORDER BY g.fecha_gasto DESC;";

$query = $pdo->prepare($sql);
$query->execute();
$gastos = $query->fetchAll(PDO::FETCH_ASSOC);

$contadorGastos = 0;
foreach ($gastos as $gasto) {
    $contadorGastos++;
}

?>
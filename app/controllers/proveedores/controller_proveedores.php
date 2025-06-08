<?php

$sql = "SELECT * FROM tb_proveedores";
$query = $pdo->prepare($sql);
$query->execute();
$proveedores = $query->fetchAll(PDO::FETCH_ASSOC);
$contadorProveedores = $query->rowCount();

?>
<?php

$sql = "SELECT * FROM tb_roles";
$query = $pdo->prepare($sql);
$query->execute();
$roles = $query->fetchAll(PDO::FETCH_ASSOC);

$contador = 0;
foreach ($roles as $rol) {
    $contador++;
}
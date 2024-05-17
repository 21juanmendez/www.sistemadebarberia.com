<?php

$sql = "SELECT * FROM tb_servicios";
$query = $pdo->prepare($sql);
$query->execute();
$servicios = $query->fetchAll(PDO::FETCH_ASSOC);
$contadorServicios = $query->rowCount();
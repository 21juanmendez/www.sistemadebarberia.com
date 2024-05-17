<?php

$sql = "SELECT u.*, r.nombre AS nombre_rol
FROM tb_usuarios u
INNER JOIN tb_roles r ON u.id_rol = r.id_rol";

$query = $pdo->prepare($sql);
$query->execute();
$usuarios = $query->fetchAll(PDO::FETCH_ASSOC);

$contadorUsers = 0;
foreach ($usuarios as $usuario) {
    $contadorUsers++;
}
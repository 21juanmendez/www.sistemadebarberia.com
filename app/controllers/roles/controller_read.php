<?php

$id_rol=$_GET['id_rol'];

$sql = "SELECT * FROM tb_roles WHERE id_rol = $id_rol";
$query=$pdo->prepare($sql);
$query->execute();
$roles = $query->fetchAll(PDO::FETCH_ASSOC);

foreach($roles as $rol){
    $id_rol = $rol['id_rol'];
    $nombre = $rol['nombre'];
}
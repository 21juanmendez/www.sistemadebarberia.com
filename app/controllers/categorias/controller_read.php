<?php


$id_categoria = $_GET['id_categoria'];

$sql = "SELECT * FROM tb_categorias WHERE id_categoria = '$id_categoria'";
$query = $pdo->prepare($sql);
$query->execute();
$categorias = $query->fetchAll(PDO::FETCH_ASSOC);

$categorias = $categorias[0];
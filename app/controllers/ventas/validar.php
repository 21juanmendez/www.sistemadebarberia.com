<?php
$id_venta = $_GET['id_venta'];
$estado = 0;

$sql = "SELECT completa FROM tb_ventas WHERE id_venta = :id_venta";
$query = $pdo->prepare($sql);
$query->execute(array(':id_venta' => $id_venta));
$venta = $query->fetch(PDO::FETCH_ASSOC);
$estado = $venta['completa'];
ob_start(); // Iniciar el buffer de salida
// Tu código aquí

if ($estado == 1) {
    header("Location:" . $VIEWS . "/ventas");
    exit(); // Asegúrate de incluir exit después de header
}

ob_end_flush();

<?php

// Código del controlador
$id_venta = $_GET['id_venta'];
$estado = 0;

$sql = "SELECT completa FROM tb_ventas WHERE id_venta = :id_venta";
$query = $pdo->prepare($sql);
$query->execute(array(':id_venta' => $id_venta));
$venta = $query->fetch(PDO::FETCH_ASSOC);
$estado = $venta['completa'];

if ($estado == 1) {
    $_SESSION["mensaje"] = "Venta ya registrada";
    $_SESSION["icono"] = "error";
    echo '<script type="text/javascript">';
    echo 'window.location.href="' . $VIEWS . '/ventas";';
    echo '</script>';
    exit();
}

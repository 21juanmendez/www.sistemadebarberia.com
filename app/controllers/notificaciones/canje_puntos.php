<?php
$notificaciones = [];
if (isset($_SESSION['id']) && isset($_SESSION['cliente'])) {
    $id_usuario = $_SESSION['id'];
    $sqlNotif = "SELECT cc.codigo, p.nombre AS promocion, cc.fyh_expiracion 
                FROM tb_codigos_canje cc
                INNER JOIN tb_canjes_promociones cp ON cc.id_codigo = cp.id_codigo
                INNER JOIN tb_promociones p ON cp.id_promocion = p.id
                INNER JOIN tb_clientes c ON cp.id_cliente = c.id_cliente
                WHERE c.id_usuario = :id_usuario AND cc.estado = 'generado'
                ORDER BY cc.fyh_expiracion DESC";
    $queryNotif = $pdo->prepare($sqlNotif);
    $queryNotif->execute(['id_usuario' => $id_usuario]);
    $notificaciones = $queryNotif->fetchAll(PDO::FETCH_ASSOC);
}
?>

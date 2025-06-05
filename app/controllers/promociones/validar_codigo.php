<?php
include('../../config.php');

session_start();

$codigo = $_POST['codigoCanje'];

// 1. Buscar el código
$sql = "SELECT cc.*, 
               p.nombre AS nombre_promocion, 
               c.id_cliente, 
               u.nombre_completo AS cliente
        FROM tb_codigos_canje cc
        INNER JOIN tb_promociones p ON cc.id_promocion = p.id
        INNER JOIN tb_clientes c ON cc.id_cliente = c.id_cliente
        INNER JOIN tb_usuarios u ON c.id_usuario = u.id_usuario
        WHERE cc.codigo = :codigo";
$stmt = $pdo->prepare($sql);
$stmt->execute(['codigo' => $codigo]);
$canje = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$canje) {
    $_SESSION['mensaje'] = 'Código no encontrado.';
    $_SESSION['icono'] = 'error';
    header("Location:" . $VIEWS . "/promociones/puntos.php");
    exit;
}

if ($canje['estado'] !== 'generado') {
    $_SESSION['mensaje'] = 'Este código ya fue usado o está expirado.';
    $_SESSION['icono'] = 'warning';
    header("Location:" . $VIEWS . "/promociones/puntos.php");
    exit;
}

// 2. Marcar como usado
$now = date('Y-m-d H:i:s');
$pdo->prepare("UPDATE tb_codigos_canje SET estado = 'usado', fyh_uso = ? WHERE id_codigo = ?")
    ->execute([$now, $canje['id_codigo']]);

$_SESSION['mensaje'] = '✅ Código válido. Canje exitoso de la promoción: ' . $canje['nombre_promocion'] . ' por el cliente ' . $canje['cliente'];
$_SESSION['icono'] = 'success';
header('Location: ' . $VIEWS . '/promociones/puntos.php');
exit;

?>
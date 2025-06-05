<?php
session_start();
include('../../config.php');

header('Content-Type: application/json');

// Verificar sesión
if (!isset($_SESSION['id_cliente']) || !isset($_SESSION['puntos'])) {
    echo json_encode(['success' => false, 'message' => 'Sesión no válida']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$nombre = $data['nombre_promocion'] ?? '';
$puntosRequeridos = (int)($data['puntos_requeridos'] ?? 0);

// Validar datos
if ($nombre === '' || $puntosRequeridos <= 0) {
    echo json_encode(['success' => false, 'message' => 'Datos inválidos']);
    exit;
}

$id_cliente = $_SESSION['id_cliente'];
$puntos_actuales = $_SESSION['puntos'];

// Verificar si tiene puntos suficientes
if ($puntos_actuales < $puntosRequeridos) {
    echo json_encode(['success' => false, 'message' => 'No tienes suficientes puntos']);
    exit;
}

// Obtener ID de la promoción
$sql = "SELECT id FROM tb_promociones WHERE nombre = :nombre LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute(['nombre' => $nombre]);
$promo = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$promo) {
    echo json_encode(['success' => false, 'message' => 'Promoción no encontrada']);
    exit;
}

$id_promocion = $promo['id'];

// Generar código único
do {
    $codigo = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    $check = $pdo->prepare("SELECT COUNT(*) FROM tb_codigos_canje WHERE codigo = ?");
    $check->execute([$codigo]);
} while ($check->fetchColumn() > 0);

// Insertar código en tabla de códigos de canje
$now = date('Y-m-d H:i:s');
$expira = date('Y-m-d H:i:s', strtotime('+3 hours'));

$sqlInsert = "INSERT INTO tb_codigos_canje (id_cliente, id_promocion, codigo, fyh_generacion, fyh_expiracion)
              VALUES (:cliente, :promo, :codigo, :generado, :expira)";
$stmtInsert = $pdo->prepare($sqlInsert);
$stmtInsert->execute([
    'cliente' => $id_cliente,
    'promo' => $id_promocion,
    'codigo' => $codigo,
    'generado' => $now,
    'expira' => $expira
]);

$id_codigo = $pdo->lastInsertId();

// Insertar en historial de canjes
$sqlCanje = "INSERT INTO tb_canjes_promociones (id_cliente, id_promocion, id_codigo, puntos_utilizados, fyh_canje)
             VALUES (:cliente, :promo, :codigo, :puntos, :fecha)";
$stmtCanje = $pdo->prepare($sqlCanje);
$stmtCanje->execute([
    'cliente' => $id_cliente,
    'promo' => $id_promocion,
    'codigo' => $id_codigo,
    'puntos' => $puntosRequeridos,
    'fecha' => $now
]);

// Actualizar puntos en sesión y base de datos
$_SESSION['puntos'] -= $puntosRequeridos;
$stmtUpdate = $pdo->prepare("UPDATE tb_clientes SET acumulado_puntos = :puntos WHERE id_cliente = :id");
$stmtUpdate->execute([
    'puntos' => $_SESSION['puntos'],
    'id' => $id_cliente
]);

echo json_encode(['success' => true, 'codigo' => $codigo]);
exit;
?>

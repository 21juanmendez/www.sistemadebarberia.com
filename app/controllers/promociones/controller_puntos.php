<?php
// Obtener el filtro de estado desde GET
$filtroEstado = isset($_GET['estado']) ? $_GET['estado'] : 'todos';

// Construir la consulta SQL base
$sql = "SELECT 
    cp.id_canje,
    u.nombre_completo AS cliente,
    p.nombre AS promocion,
    cp.puntos_utilizados,
    cp.fyh_canje,
    cc.estado,
    cc.fyh_uso
FROM tb_canjes_promociones cp
INNER JOIN tb_codigos_canje cc ON cp.id_codigo = cc.id_codigo
INNER JOIN tb_promociones p ON cp.id_promocion = p.id
INNER JOIN tb_clientes c ON cp.id_cliente = c.id_cliente
INNER JOIN tb_usuarios u ON c.id_usuario = u.id_usuario";

// Agregar condición WHERE según el filtro
if ($filtroEstado !== 'todos') {
    $sql .= " WHERE cc.estado = :estado";
}

$sql .= " ORDER BY cp.fyh_canje DESC";

$query = $pdo->prepare($sql);

// Bindear parámetro si hay filtro específico
if ($filtroEstado !== 'todos') {
    $query->bindParam(':estado', $filtroEstado);
}

$query->execute();
$canjes = $query->fetchAll(PDO::FETCH_ASSOC);

// Actualizar estado de canjes expirados
$sqlUpdate = "UPDATE tb_codigos_canje SET estado = 'expirado' 
WHERE estado = 'generado' AND fyh_expiracion < NOW()";
$queryUpdate = $pdo->prepare($sqlUpdate);
$queryUpdate->execute();

// Devolver puntos de canjes expirados
$sql = "SELECT 
            c.id_cliente, cp.puntos_utilizados, cc.id_codigo
        FROM tb_codigos_canje cc
        INNER JOIN tb_canjes_promociones cp ON cc.id_codigo = cp.id_codigo
        INNER JOIN tb_clientes c ON cc.id_cliente = c.id_cliente
        WHERE cc.estado = 'expirado'
        AND cc.fyh_expiracion < NOW()
        AND cc.puntos_devueltos = FALSE";

$query = $pdo->prepare($sql);
$query->execute();
$expirados = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($expirados as $row) {
    // Sumar los puntos
    $pdo->prepare("UPDATE tb_clientes SET acumulado_puntos = acumulado_puntos + :puntos WHERE id_cliente = :id")
        ->execute(['puntos' => $row['puntos_utilizados'], 'id' => $row['id_cliente']]);

    // Marcar como devuelto
    $pdo->prepare("UPDATE tb_codigos_canje SET puntos_devueltos = TRUE WHERE id_codigo = :codigo")
        ->execute(['codigo' => $row['id_codigo']]);
}

$cantidadCanjes = count($canjes);

// Obtener conteos por estado para mostrar en el filtro
$sqlConteos = "SELECT 
    cc.estado,
    COUNT(*) as cantidad
FROM tb_canjes_promociones cp
INNER JOIN tb_codigos_canje cc ON cp.id_codigo = cc.id_codigo
GROUP BY cc.estado";

$queryConteos = $pdo->prepare($sqlConteos);
$queryConteos->execute();
$conteosPorEstado = $queryConteos->fetchAll(PDO::FETCH_ASSOC);

// Convertir a array asociativo para fácil acceso
$conteos = [];
foreach ($conteosPorEstado as $conteo) {
    $conteos[$conteo['estado']] = $conteo['cantidad'];
}

// Obtener conteo total
$sqlTotal = "SELECT COUNT(*) as total FROM tb_canjes_promociones";
$queryTotal = $pdo->prepare($sqlTotal);
$queryTotal->execute();
$conteoTotal = $queryTotal->fetch(PDO::FETCH_ASSOC)['total'];
?>
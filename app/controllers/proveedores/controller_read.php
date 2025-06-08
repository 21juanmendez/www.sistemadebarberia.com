<?php
$id_proveedor = $_GET['id_proveedor'];

$sql = "SELECT * FROM tb_proveedores WHERE id_proveedor = :id_proveedor";
$query = $pdo->prepare($sql);
$query->bindParam(':id_proveedor', $id_proveedor);
$query->execute();
$proveedores = $query->fetchAll(PDO::FETCH_ASSOC);

if (count($proveedores) > 0) {
    foreach ($proveedores as $proveedor) {
        $nombre_empresa = $proveedor['nombre_empresa'];
        $nombre_contacto = $proveedor['nombre_contacto'];
        $email = $proveedor['email'];
        $telefono = $proveedor['telefono'];
        $direccion = $proveedor['direccion'];
    }
} else {
    // Si no se encuentra el proveedor, redirigir
    session_start();
    $_SESSION['mensaje'] = "Proveedor no encontrado";
    $_SESSION['icono'] = 'error';
    header('Location: ' . $VIEWS . '/proveedores/');
    exit;
}
?>
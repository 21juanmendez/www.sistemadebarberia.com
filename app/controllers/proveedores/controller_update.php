<?php
include('../../config.php');

$id_proveedor = $_POST['id_proveedor'];
$nombre_empresa = $_POST['nombre_empresa'];
$nombre_contacto = $_POST['nombre_contacto'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];

$sql = "UPDATE tb_proveedores 
            SET nombre_empresa = :nombre_empresa,
                nombre_contacto = :nombre_contacto,
                email = :email,
                telefono = :telefono,
                direccion = :direccion
            WHERE id_proveedor = :id_proveedor";

$query = $pdo->prepare($sql);
$query->bindParam(':id_proveedor', $id_proveedor);
$query->bindParam(':nombre_empresa', $nombre_empresa);
$query->bindParam(':nombre_contacto', $nombre_contacto);
$query->bindParam(':email', $email);
$query->bindParam(':telefono', $telefono);
$query->bindParam(':direccion', $direccion);

if ($query->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Proveedor actualizado correctamente";
    $_SESSION['icono'] = 'success';
    header('Location: ' . $VIEWS . '/proveedores/');
} else {
    session_start();
    $_SESSION['mensaje'] = "Error al actualizar el proveedor";
    $_SESSION['icono'] = 'error';
    header('Location: ' . $VIEWS . '/proveedores/update.php?id_proveedor=' . $id_proveedor);
}

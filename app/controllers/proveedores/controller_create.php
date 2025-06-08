<?php
include('../../config.php');

$nombre_empresa = $_POST['nombre_empresa'];
$nombre_contacto = $_POST['nombre_contacto'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];

$sql = "INSERT INTO tb_proveedores (nombre_empresa, nombre_contacto, email, telefono, direccion) 
        VALUES (:nombre_empresa, :nombre_contacto, :email, :telefono, :direccion)";

$query = $pdo->prepare($sql);
$query->bindParam(':nombre_empresa', $nombre_empresa);
$query->bindParam(':nombre_contacto', $nombre_contacto);
$query->bindParam(':email', $email);
$query->bindParam(':telefono', $telefono);
$query->bindParam(':direccion', $direccion);

if ($query->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Proveedor registrado correctamente";
    $_SESSION['icono'] = 'success';
    header('Location: ' . $VIEWS . '/proveedores/');
} else {
    session_start();
    $_SESSION['mensaje'] = "Error al registrar el proveedor";
    $_SESSION['icono'] = 'error';
    header('Location: ' . $VIEWS . '/proveedores/create.php');
}
?>
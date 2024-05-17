<?php
include('../../config.php');

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM tb_usuarios WHERE email ='$email'";
$query = $pdo->prepare($sql);
$query->execute();
// devuelve un arreglo según la consulta{id, nombre, email, password, cargo, fecha}
$usuarios = $query->fetchAll(PDO::FETCH_ASSOC);

if (empty($usuarios)) {
    session_start();
    $_SESSION['mensaje'] = 'El correo no existe';
    $_SESSION['icono'] = 'error';
    header('Location: ' . $VIEWS . '/login');
} else {
    $sql = "SELECT * FROM tb_usuarios usuarios INNER JOIN 
    tb_roles rol ON usuarios.id_rol=rol.id_rol WHERE usuarios.email='$email'";
    $query = $pdo->prepare($sql);
    $query->execute();
    $usuario = $query->fetch(PDO::FETCH_ASSOC);

    session_start();
    if (password_verify($password, $usuario['password']) && ($usuario['nombre'] == "ADMINISTRADOR" || $usuario['nombre'] == "Administrador")) {
        $_SESSION['admin'] = $usuario['nombre_completo'];
        $_SESSION['email'] = $usuario['email'];
        $_SESSION['mensaje'] = $usuario['nombre_completo'];
        $_SESSION['icono'] = 'success';
        header('Location: ' . $VIEWS . "/usuarios");
    } elseif (password_verify($password, $usuario['password']) && ($usuario['nombre'] == "CLIENTE" || $usuario['nombre'] == "Cliente")) {
        $_SESSION['cliente'] = $usuario['nombre_completo'];
        $_SESSION['mensaje'] = $usuario['nombre_completo'];
        $_SESSION['icono'] = 'success';
        header('Location: ' . $URL . "/index.php");
    } else {
        // Contraseña incorrecta
        $_SESSION['mensaje'] = 'Contraseña incorrecta';
        $_SESSION['icono'] = 'error';
        header('Location: ' . $VIEWS . '/login');
    }
}

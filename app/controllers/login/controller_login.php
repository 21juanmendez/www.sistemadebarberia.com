<?php
include('../../config.php');

$email = $_POST['email'];
$password = $_POST['password'];

// Primera consulta: verificar si el usuario existe
$sql = "SELECT * FROM tb_usuarios WHERE email = :email";
$query = $pdo->prepare($sql);
$query->execute(['email' => $email]);
$usuario = $query->fetch(PDO::FETCH_ASSOC);

session_start();

if (!$usuario) {
    $_SESSION['mensaje'] = 'El correo no existe';
    $_SESSION['icono'] = 'error';
    header('Location: ' . $VIEWS . '/login');
    exit();
}

// Verificar la contraseña PRIMERO
if (!password_verify($password, $usuario['password'])) {
    $_SESSION['mensaje'] = 'Contraseña incorrecta';
    $_SESSION['icono'] = 'error';
    header('Location: ' . $VIEWS . '/login');
    exit();
}

// Si llegamos aquí, la contraseña es correcta
// Ahora obtenemos los datos completos con el rol
$sql = "SELECT usuarios.*, rol.nombre as nombre_rol, cliente.acumulado_puntos 
        FROM tb_usuarios usuarios 
        INNER JOIN tb_roles rol ON usuarios.id_rol = rol.id_rol 
        LEFT JOIN tb_clientes cliente ON usuarios.id_usuario = cliente.id_usuario
        WHERE usuarios.email = :email";
$query = $pdo->prepare($sql);
$query->execute(['email' => $email]);
$usuario_completo = $query->fetch(PDO::FETCH_ASSOC);

// Guardar ID en sesión
$_SESSION['id'] = $usuario_completo['id_usuario'];

// Verificar el rol del usuario
if ($usuario_completo['nombre_rol'] == "ADMINISTRADOR" || $usuario_completo['nombre_rol'] == "Administrador") {
    $_SESSION['id_usuario'] = $usuario_completo['id_usuario'];
    $_SESSION['admin'] = $usuario_completo['nombre_completo'];
    $_SESSION['email'] = $usuario_completo['email'];
    $_SESSION['mensaje'] = '<h1>Bienvenido</h1>' . $usuario_completo['nombre_completo'];
    $_SESSION['icono'] = 'success';
    header('Location: ' . $VIEWS . "/usuarios");
} elseif ($usuario_completo['nombre_rol'] == "CLIENTE" || $usuario_completo['nombre_rol'] == "Cliente") {
    $_SESSION['cliente'] = $usuario_completo['nombre_completo'];
    $_SESSION['puntos'] = $usuario_completo['acumulado_puntos'] ?? 0;
    $_SESSION['mensaje'] = $usuario_completo['nombre_completo'];
    $_SESSION['icono'] = 'success';
    header('Location: ' . $URL . "/index.php");
} else {
    // Rol no reconocido o no autorizado
    $_SESSION['mensaje'] = 'Usuario no autorizado';
    $_SESSION['icono'] = 'error';
    header('Location: ' . $VIEWS . '/login');
}

exit();
?>
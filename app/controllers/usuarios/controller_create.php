<?php
include('../../config.php');

session_start();

$id_rol = $_POST['id_rol'];
$name = $_POST['nombre'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$fyh_creacion = date('Y-m-d H:i:s'); // Obtener la fecha y hora actual

$sql = "SELECT * FROM tb_usuarios WHERE email = '$email'";
$query = $pdo->prepare($sql);
$query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC);

if ($result && isset($_SESSION['admin'])) { // Si el correo ya existe y es administrador
    $_SESSION['mensaje'] = 'El correo ya existe';
    $_SESSION['icono'] = 'error';
    header('Location:' . $VIEWS . '/usuarios/create.php');
    exit(); // Terminar el script después de redirigir
} elseif ($password == $password2 && isset($_SESSION['admin'])) {
    $encriptada = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO tb_usuarios (id_rol, nombre_completo,telefono, email, password, fyh_creacion)
            VALUES ('$id_rol', '$name','$telefono', '$email', '$encriptada', '$fyh_creacion')";
    $query = $pdo->prepare($sql);
    $query->execute();
    $_SESSION['mensaje'] = 'Usuario creado correctamente';
    $_SESSION['icono'] = 'success';
    header('Location:' . $VIEWS . '/usuarios/usuarios.php');
    exit(); // Terminar el script después de redirigir
} elseif ($result && !isset($_SESSION['admin'])) { // Si el correo ya existe y no es administrador
    $_SESSION['mensaje'] = 'El correo ya existe';
    $_SESSION['icono'] = 'error';
    header('Location:' . $VIEWS . '/login/registro.php');
    exit(); // Terminar el script después de redirigir
} elseif ($password == $password2 && !isset($_SESSION['admin'])) {
    $encriptada = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO tb_usuarios (id_rol, nombre_completo,telefono, email, password, fyh_creacion)
            VALUES ('$id_rol', '$name','$telefono', '$email', '$encriptada', '$fyh_creacion')";
    $query = $pdo->prepare($sql);
    $query->execute();

    //Obetener el id del usuario creado
    $sql = "SELECT * FROM tb_usuarios WHERE email = '$email'";
    $query = $pdo->prepare($sql);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    $id_usuario = $result['id_usuario'];

    //Crear cliente
    $sql = "INSERT INTO tb_clientes (id_usuario)
            VALUES ('$id_usuario')";
    $query = $pdo->prepare($sql);
    $query->execute();

    $_SESSION['mensaje'] = 'Usuario creado correctamente';
    $_SESSION['icono'] = 'success';
    header('Location:' . $VIEWS . '/login');
    exit(); // Terminar el script después de redirigir
} elseif ($password != $password2 && isset($_SESSION['admin'])) {
    $_SESSION['mensaje'] = 'Las contraseñas no coinciden';
    $_SESSION['icono'] = 'error';
    header('Location:' . $VIEWS . '/usuarios/create.php');
    exit(); // Terminar el script después de redirigir
} else {
    $_SESSION['mensaje'] = 'Las contraseñas no coinciden';
    $_SESSION['icono'] = 'error';
    header('Location:' . $VIEWS . '/login/registro.php');
    exit(); // Terminar el script después de redirigir
}

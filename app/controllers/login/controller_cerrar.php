<?php
include("../../config.php");
session_start();

if (isset($_GET['type'])) {
    $type = $_GET['type'];

    if (($type == 'admin' && isset($_SESSION['admin'])) || ($type == 'cliente' && isset($_SESSION['cliente']))) {
        session_unset(); // Elimina todas las variables de sesión
        session_destroy(); // Destruye la sesión
        session_start(); // Reinicia la sesión para mostrar el mensaje de sesión cerrada
        $_SESSION['mensaje'] = 'Sesión cerrada correctamente';
        $_SESSION['icono'] = 'success';
        header('Location: ' . $URL . '/index.php');
        exit();
    } else {
        $_SESSION['mensaje'] = 'No se pudo cerrar la sesión';
        $_SESSION['icono'] = 'error';
        header('Location: ' . $URL . '/index.php');
        exit();
    }
} else {
    $_SESSION['mensaje'] = 'No se especificó el tipo de sesión a cerrar';
    $_SESSION['icono'] = 'info';
    header('Location: ' . $URL . '/index.php');
    exit();
}

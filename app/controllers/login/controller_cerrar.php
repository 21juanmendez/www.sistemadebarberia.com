<?php
include("../../config.php");
session_start();

if (isset($_GET['type'])) {
    $type = $_GET['type'];

    if ($type == 'admin' && isset($_SESSION['admin'])) {
        unset($_SESSION['admin']);
        unset($_SESSION['email']);
        $_SESSION['mensaje'] = 'Sesión cerrada correctamente';
        header('Location: ' . $URL . '/index.php');
    } elseif ($type == 'cliente' && isset($_SESSION['cliente'])) {
        unset($_SESSION['cliente']);
        $_SESSION['mensaje'] = 'Sesión cerrada correctamente';
        header('Location: ' . $URL . '/index.php');
    } else {
        $_SESSION['mensaje'] = 'No se pudo cerrar la sesión';
    }
    $_SESSION['icono'] = 'success';
} else {
    $_SESSION['mensaje'] = 'No se especificó el tipo de sesión a cerrar';
    $_SESSION['icono'] = 'info';
}


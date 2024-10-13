<?php
include('app/config.php');
include('app/controllers/productos/controller_productos.php');
include('app/controllers/servicios/controller_servicios.php');
session_start();
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Icono y Titulo de la Página-->
    <link rel="icon" type="image/png" href="public/imagenes/logo.jpg">
    <title> Area51</title>
    <!--<ESTILOS CSS>-->
    <link href="public/css/style.css" rel="stylesheet">
    <!--<BOOTSTRAP>-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!--<ICONOS DE BOOTSTRAP>-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!--<JQUERY>-->
    <script src="public/js/jquery-3.7.1.min.js"></script>
    <!-- jquery-->
    <script src="<?php echo $URL ?>/public/templates/plugins/jquery/jquery.min.js"></script>
    <!-- SWEET ALERT2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!--NAVBAR-->
    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="public/imagenes/logo.jpg" alt="Logo" width="40" height="40" class="d-inline-block align-text-center">
                <b>Area51</b>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $URL ?>#our-services">
                            Servicios
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="productos.php" class="nav-link">
                            Productos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="registrar_cita.php" class="nav-link">
                            Reservar cita
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <?php include('views/login/mensaje.php'); ?>
                        <?php if (isset($_SESSION['cliente'])) { ?>
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-fill-check"></i> <?php echo $_SESSION['cliente'] ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="app/controllers/login/controller_cerrar.php?type=cliente">Cerrar Sesión</a></li>
                            </ul>
                        <?php } elseif (isset($_SESSION['admin'])) { ?>
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-fill-check"></i> <?php echo $_SESSION['admin'] ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="views/usuarios">Panel Administrativo</a></li>
                                <li><a class="dropdown-item" href="app/controllers/login/controller_cerrar.php?type=admin">Cerrar Sesión</a></li>
                            </ul>
                        <?php } else { ?>
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="views/login/index.php">Iniciar Sesión</a></li>
                                <li><a class="dropdown-item" href="views/login/registro.php">Registrarse</a></li>
                            </ul>
                        <?php } ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--FIN NAVBAR-->
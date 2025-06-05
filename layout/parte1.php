<?php
include('app/config.php');
session_start();
include('app/controllers/productos/controller_productos.php');
include('app/controllers/servicios/controller_servicios.php');
include('app/controllers/promociones/obtener_promociones.php');
include('app/controllers/notificaciones/canje_puntos.php');
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Icono y Titulo de la Página-->
    <link rel="icon" type="image/png" href="public/imagenes/LOGO-AREA51.png">
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
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        .points-display {
            background: rgba(97, 218, 251, 0.1);
            /* Un tono suave del azul principal */
            border: 1px solid rgba(97, 218, 251, 0.3);
            /* Bordes en el mismo azul */
            border-radius: 8px;
            padding: 8px 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .points-number {
            color: #48a7c7;
            /* Un azul más oscuro, pero acorde al tema */
            font-weight: 600;
        }

        .points-text {
            color: #b0dff5;
            /* Un azul claro para buena visibilidad */
            font-size: 0.875rem;
        }

        .notificacion-badge {
            top: 10%;
            left: 60%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>

<body>
    <!--NAVBAR-->
    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="public/imagenes/LOGO-AREA51.png" alt="Logo" width="40" height="40" class="d-inline-block align-text-center">
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

                    <?php if (isset($_SESSION['cliente'])) { ?>
                        <li class="nav-item">
                            <a href="canjear_puntos.php" class="nav-link">
                                Canjear puntos
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (isset($_SESSION['cliente']) || isset($_SESSION['admin'])) { ?>
                        <li class="nav-item">
                            <a href="seguimiento.php" class="nav-link">
                                Mis citas
                            </a>
                        </li>
                    <?php } ?>
                </ul>

                <ul class="navbar-nav">
                    <?php if (!empty($notificaciones)) { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle position-relative" href="#" id="notifDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-bell-fill"></i>
                                <span class="position-absolute badge rounded-pill bg-danger notificacion-badge">
                                    <?= count($notificaciones) ?>
                                </span>

                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notifDropdown">
                                <?php foreach ($notificaciones as $notif) { ?>
                                    <li>
                                        <a class="dropdown-item small">
                                            <strong><?= htmlspecialchars($notif['promocion']) ?></strong><br>
                                            Código: <span class="text-primary"><?= htmlspecialchars($notif['codigo']) ?></span><br>
                                            <small class="text-muted">Válido hasta <?= date('d/m/Y H:i', strtotime($notif['fyh_expiracion'])) ?></small>
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>

                    <?php if (isset($_SESSION['cliente'])) { ?>
                        <div class="points-display">
                            <i class="bi bi-award text-white"></i>
                            <span class="points-number" id="userPoints"><?php echo $_SESSION['puntos'] ?></span>
                            <span class="points-text">puntos</span>
                        </div>
                    <?php } ?>
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
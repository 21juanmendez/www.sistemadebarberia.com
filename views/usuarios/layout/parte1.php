<?php
include('../../app/config.php');
include('../../app/controllers/notificaciones/productos_bajos.php');
session_start();
//si no existe la session de admin te redirige al login, lo que no se es cuando existan las 2
if (!isset($_SESSION['admin'])) {
    $_SESSION['icono'] = 'error';
    $_SESSION['mensaje_permiso'] = 'No tienes los permisos para entrar en modo administrador';
    header('Location:' . $URL . '/');
}
// Verifica si las variables están definidas, si no, las inicializa
if (!isset($productos_bajos)) $productos_bajos = 0;
if (!isset($stocks_notif)) $stocks_notif = [];
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="<?php echo $URL ?>/public/templates/dist/img/AdminLTELogo.png"">
    <title style=" text-align: center;"> Administrador</title>

    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo $URL ?>/public/templates/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo $URL ?>/public/templates/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo $URL ?>/public/templates/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- ICONOS BOOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- jquery-->
    <script src="<?php echo $URL ?>/public/js/jquery-3.7.1.min.js"></script>
    <!-- SWEET ALERT2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- ChartJS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?php echo $URL ?>/public/templates/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $URL ?>/public/templates/dist/css/adminlte.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div id="ocultar_preloader" class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="<?php echo $URL ?>/public/templates/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?php echo $URL ?>" class="nav-link">Inicio</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <?php 
                // Mostrar el toast de bienvenida y stock bajo si la sesión lo indica
                if (isset($_SESSION['mostrar_toast_stock']) && $_SESSION['mostrar_toast_stock']) : ?>
                    <script>
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Bienvenido <?php echo $_SESSION["admin"]; ?>',
                            showConfirmButton: false,
                            timer: 1000,
                            timerProgressBar: true
                        });

                        setTimeout(() => {
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'warning',
                                title: '<?php echo $productos_bajos ?> producto<?php echo $productos_bajos > 1 ? "s" : "" ?> con stock bajo',
                                showConfirmButton: false,
                                timer: 5000,
                                timerProgressBar: true
                            });
                        }, 1000);
                    </script>
                    <?php unset($_SESSION['mostrar_toast_stock']); ?>
                <?php endif; ?>

                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link position-relative" data-toggle="dropdown" href="#" title="Notificaciones de inventario">
                        <i class="far fa-bell"></i>
                        <?php if ($productos_bajos > 0): ?>
                            <span class="badge badge-danger navbar-badge animate__animated animate__bounceIn">
                                <?php echo $productos_bajos; ?>
                            </span>
                        <?php endif; ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right animate__animated animate__fadeIn">
                        <?php if ($productos_bajos > 0): ?>
                            <span class="dropdown-item dropdown-header text-danger fw-bold">
                                <i class="fas fa-box-open text-danger"></i> <?php echo $productos_bajos; ?> productos con stock bajo
                            </span>
                            <div class="dropdown-divider"></div>

                            <?php foreach ($stocks_notif as $prod): ?>
                                <?php if ($prod['stock'] <= $prod['stock_minimo']): ?>
                                    <a href="#" class="dropdown-item d-flex align-items-center">
                                        <i class="fas fa-exclamation-triangle text-warning mr-2"></i>
                                        <span class="flex-grow-1"><?php echo htmlspecialchars($prod['nombre_producto']); ?></span>
                                        <span class="text-muted text-sm"><?php echo $prod['stock'] . '/' . $prod['stock_minimo']; ?></span>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                <?php endif; ?>
                            <?php endforeach; ?>

                            <a href="<?php echo $URL ?>/views/productos/index.php" class="dropdown-item dropdown-footer text-primary">
                                <i class="fas fa-boxes"></i> Ver todos los productos
                            </a>

                        <?php else: ?>
                            <span class="dropdown-item text-center text-muted">
                                No hay alertas de stock
                            </span>
                        <?php endif; ?>
                    </div>
                </li>

                <!-- BOTÓN DE MODO OSCURO EN NAVBAR -->
                <li class="nav-item">
                    <a class="nav-link" href="#" id="darkModeToggle" role="button" title="Modo oscuro">
                        <i class="fas fa-moon"></i>
                    </a>
                </li>
                <!-- JS PARA MODO OSCURO -->
                <script>
                    const toggle = document.getElementById('darkModeToggle');

                    // Aplicar modo oscuro al cargar, si ya estaba activado
                    if (localStorage.getItem('modo') === 'oscuro') {
                        document.body.classList.add('dark-mode');
                    }

                    // Alternar y guardar preferencia
                    toggle.addEventListener('click', function() {
                        document.body.classList.toggle('dark-mode');
                        const modoActual = document.body.classList.contains('dark-mode') ? 'oscuro' : 'claro';
                        localStorage.setItem('modo', modoActual);
                    });
                </script>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?php echo $VIEWS ?>/usuarios/" class="brand-link">
                <img src="<?php echo $URL ?>/public/templates/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">ADMINISTRADOR</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
                    <div class="image">
                        <img src="<?php echo $URL ?>/public/imagenes/user.png" class="img-circle elevation-2" alt="User Image" style="width: 35px; height: 35px;">
                    </div>
                    <div class="info ms-2">
                        <!-- Aquí va el nombre (cualquiera de las opciones anteriores) -->
                        <a class="d-block text-truncate" style="max-width: 140px;" title="<?php echo $_SESSION['admin']; ?>">
                            <?php echo $_SESSION['admin']; ?>
                        </a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item menu-closed">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $VIEWS ?>/usuarios" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Inicio</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item menu-closed">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-address-card"></i>
                                <p>
                                    Roles
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $VIEWS ?>/roles" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de Roles</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item menu-closed">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Usuarios
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $VIEWS ?>/usuarios/usuarios.php" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de Usuarios</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item menu-closed">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fa fa-list-alt"></i>
                                <p>
                                    Categorias
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $VIEWS ?>/categorias" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de Categorias</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="nav-item menu-closed">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-truck"></i>
                                <p>
                                    Proveedores
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $VIEWS ?>/proveedores" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de Proveedores</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Compras -->
                        <li class="nav-item menu-closed">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-receipt"></i>
                                <p>
                                    Compras
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $VIEWS ?>/compras" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de Compras</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item menu-closed">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-store"></i>
                                <p>
                                    Productos
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $VIEWS ?>/productos" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de Productos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item menu-closed">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-cut"></i>
                                <p>
                                    Servicios
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $VIEWS ?>/servicios" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de Servicios</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Promociones -->
                        <li class="nav-item menu-closed">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-gift"></i>
                                <p>
                                    Promociones de puntos
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $VIEWS ?>/promociones" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de Promociones</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $VIEWS ?>/promociones/puntos.php" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Canje de puntos</p>
                                    </a>
                                </li>
                            </ul>

                        <li class="nav-item menu-closed">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-user-tie"></i>
                                <p>
                                    Empleados
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $VIEWS ?>/empleados" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de Empleados</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item menu-closed">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-calendar-check"></i>
                                <p>
                                    Citas
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $VIEWS ?>/citas" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de Citas</p>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <li class="nav-item menu-closed">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon bi bi-cart4" style="margin-left: 5px; margin-right: 7px;"></i>
                                <p>
                                    Ventas
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $VIEWS ?>/ventas" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Historial de ventas</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $VIEWS ?>/ventas_eliminadas" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Ventas eliminadas</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item menu-closed">
                            <a href="#" class="nav-link active">
                                <i class="bi bi-pie-chart-fill" style="margin-left: 5px; margin-right: 7px;"></i>
                                <p>
                                    Reportes
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $VIEWS ?>/reportes" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Reporte de ventas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $VIEWS ?>/reportes/productos.php" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Reporte de inventario</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $VIEWS ?>/reportes/clientes.php" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Reporte de clientes</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                <a href="<?php echo $VIEWS ?>/reportes/comentarios.php" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Reporte de comentarios</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="<?php echo $URL ?>/app/controllers/login/controller_cerrar.php?type=admin" class="nav-link active" style="background-color: crimson;">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Cerrar sesion</p>
                            </a>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="container-fluid">
                <br>


                <!-- Main content -->
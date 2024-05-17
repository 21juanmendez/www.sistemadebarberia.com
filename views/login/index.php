<?php
include('../../app/config.php');
?>
<!--codigo html-->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Icono y Titulo de la Página-->
    <link rel="icon" type="image/png" href="../../public/imagenes/logo.jpg">
    <title>Login</title>
    <!-- ICONOS BOOOTSTRAP -->
    <link href="<?php echo $URL ?>/public/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?php echo $URL ?>/public/templates/plugins/fontawesome-free/css/all.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $URL ?>/public/templates/dist/css/adminlte.min.css">
    <!-- jquery-->
    <script src="<?php echo $URL ?>/public/templates/plugins/jquery/jquery.min.js"></script>
    <!-- SWEET ALERT2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="login-page" style="min-height: 539.977px;">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h2><b>Inicio de Sesión</b></h2>
            </div>
            <?php
            session_start();
            include('mensaje.php'); //para ver si se equivoca de contra o correo
            ?>
            <div class="card-body">
                <p class="login-box-msg">Ingresa tus datos</p>
                <form action="<?php echo $URL ?>/app/controllers/login/controller_login.php" method="post">
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Correo electronico" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                    <a href="<?php echo $URL ?>/index.php" class="btn btn-danger btn-block">Cancelar</a>
                    <center>
                        <p class="mb-1">
                            <a href="registro.php">¿No tienes una cuenta? Registrate</a>
                        </p>
                    </center>
                </form>
            </div>
        </div>
    </div>
    <!-- /.login-box -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="<?php echo $URL ?>/public/templates/plugins/jquery/jquery.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo $URL ?>/public/templates/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo $URL ?>/public/templates/dist/js/adminlte.min.js"></script>
</body>

</html>
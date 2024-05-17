<?php
include('../../app/config.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Icono y Titulo de la Página-->
    <link rel="icon" type="image/png" href="../../public/imagenes/logo.jpg">
    <title>Nuevo Registro</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo $URL; ?>/public/templates/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo $URL ?>/public/templates/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $URL ?>/public/templates/dist/css/adminlte.min.css">
    <!-- jquery-->
    <script src="<?php echo $URL ?>/public/templates/plugins/jquery/jquery.min.js"></script>
    <!-- SWEET ALERT2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="register-page" style="min-height: 539.977px;">
    <?php
    session_start();
    include('mensaje.php');
    ?>
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h2><b>Registrate</b></h2>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Completa los campos correspondientes</p>
                <form action="<?php echo $URL ?>/app/controllers/usuarios/controller_create.php" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="nombre" class="form-control" placeholder="Nombre completo" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="number" name="telefono" class="form-control" placeholder="Telefono" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                            </div>
                        </div>
                    </div>


                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="info@gmail.com" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope">

                                </span>
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


                    <div class="input-group mb-3">
                        <input type="password" name="password2" class="form-control" placeholder="Repita su contraseña" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <!--Al registrarse en este form lo asignamos como CLIENTE -->
                    <input type="hidden" name="id_rol" value="2">
                    <!---->
                    <button type="submit" class="btn btn-primary btn-block">Registrarse</button>
                    <a href="<?php echo $URL ?>/index.php" class="btn btn-danger btn-block">Cancelar</a>
                    <center>
                        <p class="mb-1">
                            <a href="index.php">¿Ya tienes una cuenta? Inicia sesion</a>
                        </p>
                    </center>
                </form>
            </div>
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?php echo $URL ?>/public/templates/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo $URL ?>/public/templates/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo $URL ?>/public/templates/dist/js/adminlte.min.js"></script>
</body>

</html>
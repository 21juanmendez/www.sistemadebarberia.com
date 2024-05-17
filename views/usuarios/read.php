<?php
include('layout/parte1.php');
include('../../app/controllers/usuarios/controller_read.php');
include('layout/mensaje.php');
?>
<!--codigo html-->
<div class="container-fluid">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"><b>VISUALIZAR USUARIO</b></h3>
        </div>
        <div class="card-body">
            <form class="row g-3" action="#" method="post">

                <div class="col-md-6">
                    <label>Nombre Completo</label>
                    <p><?php echo $nombre_completo?></p>
                </div>
                <div class="col-md-6">
                    <label>Correo Electronico</label>
                    <p><?php echo $email?></p>
                </div>
                <div class="col-md-6">
                    <label>Telefono</label>
                    <p><?php echo $telefono?></p>
                </div>
                <div class="col-md-6">
                    <label>Cargo</label>
                    <p><?php echo $cargo?></p>
                </div>
                <div class="col-md-6">
                    <label>Fecha de registro</label>
                    <p><?php echo $fyh_creacion?></p>
                </div>
                <div class="col-md-6">
                    <label>Fecha de actualizacion</label>
                    <p><?php echo $fyh_actualizacion?></p>
                </div>
                <center>
                    <div class="col-md-12">
                        <a href="<?php echo $URL ?>/views/usuarios/usuarios.php" class="btn btn-secondary">Regresar</a>
                    </div>
                </center>
            </form>
        </div>
    </div>
</div>
<?php
include('layout/parte2.php');
?>
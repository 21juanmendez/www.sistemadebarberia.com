<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/citas/controller_read.php');
?>

<div class="container-fluid">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"><b>VISUALIZAR CITA</b></h3>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-4">
                    <label>Rol:</label>
                    <p><?php echo $rol ?></p>
                </div>
                <div class="col-md-4">
                    <label>Nombre de usuario:</label>
                    <p><?php echo $nombre_completo ?></p>
                </div>
                <div class="col-md-4">
                    <label>Servicio solicitado:</label>
                    <p><?php echo $nombre_servicio ?></p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label>Fecha de Cita:</label>
                    <p><?php echo $fecha_cita ?></p>
                </div>
                <div class="col-md-4">
                    <label>Hora de Cita:</label>
                    <p><?php echo $hora_cita ?></p>
                </div>
                <div class="col-md-4">
                    <label>Fecha de Registro:</label>
                    <p><?php echo $fyh_creacion ?></p>
                </div>
            </div>
            <center>
                <div class="col-md-12">
                    <a href="<?php echo $URL ?>/views/citas" class="btn btn-secondary">Regresar</a>
                </div>
            </center>
        </div>
    </div>
</div>

<?php
include('../usuarios/layout/parte2.php');
?>
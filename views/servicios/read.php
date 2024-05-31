<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/servicios/controller_read.php');
?>

<!--codigo html-->
<div class="container-fluid">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"><b>VISUALIZAR SERVICIO</b></h3>
        </div>
        <div class="card-body">
            <form action="<?php echo $URL ?>/app/controllers/servicios/controller_create.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Nombre del Servicio</label>
                                    <p><?php echo $nombre_servicio ?></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Precio</label>
                                    <p><?php echo $precio ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Descripcion</label>
                                    <p><?php echo $descripcion ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Fecha de creacion</label>
                                    <p><?php echo $fyh_creacion ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Fecha de actualizacion</label>
                                    <p><?php echo $fyh_actualizacion ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <center>
                                <label>Imagen</label>
                            </center>
                            <center>
                                <img src="<?php echo $URL ?>/public/imagenes/servicios/<?php echo $imagen ?>" width="50%" alt="Imagen del servicio">
                            </center>
                        </div>
                    </div>
                </div>
                <center>
                    <a href="<?php echo $VIEWS ?>/servicios" class="btn btn-secondary">Regresar</a>
                </center>
            </form>
        </div>
    </div>
</div>

<?php
include('../usuarios/layout/parte2.php');
?>
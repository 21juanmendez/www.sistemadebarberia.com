<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/proveedores/controller_read.php');
//include('mensaje.php');
?>
<!--codigo html-->
<div class="container-fluid">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"><b>VISUALIZAR PROVEEDOR</b></h3>
        </div>
        <div class="card-body">
            <form action="" method="">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nombre de la Empresa</label>
                                    <p><?php echo $nombre_empresa ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nombre del Contacto</label>
                                    <p><?php echo $nombre_contacto ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <p><?php echo $email ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Teléfono</label>
                                    <p><?php echo $telefono ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Dirección</label>
                                    <p><?php echo $direccion ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <center>
                    <br>
                    <a href="<?php echo $VIEWS ?>/proveedores" class="btn btn-secondary">Regresar</a>
                </center>
            </form>
        </div>
    </div>
</div>
<?php
include('../usuarios/layout/parte2.php');
?>
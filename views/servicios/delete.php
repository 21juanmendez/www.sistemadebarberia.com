<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/servicios/controller_read.php');
?>
<!--codigo html-->
<div class="container-fluid">
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title"><b>ELIMINAR SERVICIO</b></h3>
        </div>
        <div class="card-body">
            <form action="<?php echo $URL ?>/app/controllers/servicios/controller_delete.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Nombre del Servicio</label>
                                    <input  name="id_servicio" value="<?php echo $id_servicio ?>" hidden>
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
                                    <label>Descripción</label>
                                    <p><?php echo $descripcion ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Fecha de creación</label>
                                    <p><?php echo $fyh_creacion ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Fecha de actualización</label>
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
                                <img src="<?php echo $URL ?>/public/imagenes/servicios/<?php echo $imagen ?>" class="img-fluid" alt="Imagen del servicio">
                            </center>
                        </div>
                    </div>
                </div>
                <center>    
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Eliminar
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content modal-centered">
                                <div class="modal-header" style="background-color: red;">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel"><b>Eliminar Servicio<b></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>¿Esta seguro de que desea eliminar este servicio</p>
                                </div>
                                <div class="modal-footer">
                                    <center>
                                        <button type="submit" class="btn btn-danger">Aceptar</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo $VIEWS ?>/servicios" class="btn btn-secondary">Cancelar</a>
                </center>
            </form>
        </div>
    </div>
</div>
<?php
include('../usuarios/layout/parte2.php');
?>
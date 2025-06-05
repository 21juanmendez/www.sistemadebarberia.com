<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/promociones/controller_read.php');
?>
<!--codigo html-->
<div class="container-fluid">
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title"><b>ELIMINAR PROMOCIÓN</b></h3>
        </div>
        <div class="card-body">
            <form action="<?php echo $URL ?>/app/controllers/promociones/controller_delete.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Nombre de la Promoción</label>
                                    <input name="id_promocion" value="<?php echo $id_promocion ?>" hidden>
                                    <p><strong><?php echo $nombre ?></strong></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Puntos Requeridos</label>
                                    <p><span class="badge bg-warning text-dark fs-6"><?php echo $puntos_requeridos ?> pts</span></p>
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Estado</label>
                                    <p>
                                        <?php if ($activo == 1): ?>
                                            <span class="badge bg-success fs-6">Activa</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary fs-6">Inactiva</span>
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fecha de creación</label>
                                    <p><?php echo date('d/m/Y H:i', strtotime($created_at)) ?></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fecha de actualización</label>
                                    <p><?php echo $updated_at ? date('d/m/Y H:i', strtotime($updated_at)) : 'Sin actualizar' ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <center>
                                <label>Imagen de la Promoción</label>
                            </center>
                            <center>
                                <img src="<?php echo $URL ?>/public/imagenes/promociones/<?php echo $imagen ?>" 
                                     class="img-fluid rounded shadow" 
                                     style="max-width: 100%; height: auto;" 
                                     alt="Imagen de la promoción">
                            </center>
                        </div>
                    </div>
                </div>
                <center>    
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <i class="bi bi-trash-fill"></i> Eliminar
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content modal-centered">
                                <div class="modal-header" style="background-color: #dc3545; color: white;">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel"><b>Eliminar Promoción</b></h1>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center">
                                        <i class="bi bi-exclamation-triangle-fill text-warning" style="font-size: 3rem;"></i>
                                        <h5 class="mt-2">¿Está seguro de que desea eliminar esta promoción?</h5>
                                        <p class="text-muted">Esta acción no se puede deshacer.</p>
                                        <p><strong>"<?php echo $nombre ?>"</strong></p>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <button type="submit" class="btn btn-danger">
                                        <i class="bi bi-trash-fill"></i> Sí, Eliminar
                                    </button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        <i class="bi bi-x-circle"></i> Cancelar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo $VIEWS ?>/promociones" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Regresar
                    </a>
                </center>
            </form>
        </div>
    </div>
</div>
<?php
include('../usuarios/layout/parte2.php');
?>
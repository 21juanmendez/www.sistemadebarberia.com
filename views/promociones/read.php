<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/promociones/controller_read.php');
?>

<!--codigo html-->
<div class="container-fluid">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"><b>VISUALIZAR PROMOCIÓN</b></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Nombre de la Promoción</label>
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
                <a href="<?php echo $VIEWS ?>/promociones" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Regresar
                </a>
                <a href="<?php echo $VIEWS ?>/promociones/update.php?id=<?php echo $id_promocion ?>" class="btn btn-success">
                    <i class="bi bi-pencil-square"></i> Editar
                </a>
            </center>
        </div>
    </div>
</div>

<?php
include('../usuarios/layout/parte2.php');
?>
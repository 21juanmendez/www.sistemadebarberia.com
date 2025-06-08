<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/categorias_gastos/controller_categorias.php');
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><b>DETALLES DE CATEGORÍA DE GASTO</b></h3>
                </div>
                <div class="card-body">
                    <?php if (isset($categoria_gasto) && $categoria_gasto): ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nombre">Nombre de la categoría</label>
                                    <p class="form-control-static border p-2 bg-light"><?php echo $categoria_gasto['nombre']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fyh_creacion">Fecha de creación</label>
                                    <p class="form-control-static border p-2 bg-light"><?php echo $categoria_gasto['fyh_creacion']; ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fyh_actualizacion">Fecha de actualización</label>
                                    <p class="form-control-static border p-2 bg-light"><?php echo $categoria_gasto['fyh_actualizacion'] ? $categoria_gasto['fyh_actualizacion'] : 'Sin actualizar'; ?></p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="<?php echo $VIEWS; ?>/categorias_gastos/" class="btn btn-secondary">Volver</a>
                                <a href="<?php echo $VIEWS; ?>/categorias_gastos/update.php?id_categoria_gasto=<?php echo $categoria_gasto['id_categoria_gasto']; ?>" class="btn btn-success">Editar</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning">
                            <strong>¡Atención!</strong> No se encontró la categoría solicitada.
                        </div>
                        <a href="<?php echo $VIEWS; ?>/categorias_gastos/" class="btn btn-secondary">Volver al listado</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include('../usuarios/layout/parte2.php');
?>
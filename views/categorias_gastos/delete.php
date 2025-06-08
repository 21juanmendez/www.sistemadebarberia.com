<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/categorias_gastos/controller_categorias.php');
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title"><b>ELIMINAR CATEGORÍA DE GASTO</b></h3>
                </div>
                <div class="card-body">
                    <?php if (isset($categoria_gasto) && $categoria_gasto): ?>
                        <div class="alert alert-warning">
                            <strong>¡Atención!</strong> ¿Está seguro de que desea eliminar esta categoría?
                        </div>
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
                                <a href="<?php echo $VIEWS; ?>/categorias_gastos/" class="btn btn-secondary">Cancelar</a>
                                <form action="../../app/controllers/categorias_gastos/controller_delete.php" method="post" style="display: inline;">
                                    <input type="hidden" name="id_categoria_gasto" value="<?php echo $categoria_gasto['id_categoria_gasto']; ?>">
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalConfirmarEliminacion">
                                        Eliminar categoría
                                    </button>

                                </form>
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
<!-- Modal de confirmación centrado -->
<div class="modal fade" id="modalConfirmarEliminacion" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="../../app/controllers/categorias_gastos/controller_delete.php" method="post">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="modalLabel">Confirmar eliminación</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    ¿Está seguro de que desea eliminar esta categoría de gasto? Esta acción no se puede deshacer.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <input type="hidden" name="id_categoria_gasto" value="<?php echo $categoria_gasto['id_categoria_gasto']; ?>">
                    <button type="submit" class="btn btn-danger">Sí, eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include('../usuarios/layout/parte2.php');
?>
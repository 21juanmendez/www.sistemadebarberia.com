<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/categorias_gastos/controller_categorias.php');
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title"><b>EDITAR CATEGORÍA DE GASTO</b></h3>
                </div>
                <div class="card-body">
                    <?php if (isset($categoria_gasto) && $categoria_gasto): ?>
                        <form action="../../app/controllers/categorias_gastos/controller_update.php" method="post">
                            <input type="hidden" name="id_categoria_gasto" value="<?php echo $categoria_gasto['id_categoria_gasto']; ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre">Nombre de la categoría <b>*</b></label>
                                        <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $categoria_gasto['nombre']; ?>" required>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="<?php echo $VIEWS; ?>/categorias_gastos/" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-success">Actualizar categoría</button>
                                </div>
                            </div>
                        </form>
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
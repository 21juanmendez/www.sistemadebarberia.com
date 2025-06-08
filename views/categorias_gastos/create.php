<?php
include('../usuarios/layout/parte1.php');
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b>REGISTRO DE NUEVA CATEGORÍA DE GASTO</b></h3>
                </div>
                <div class="card-body">
                    <form action="../../app/controllers/categorias_gastos/controller_create.php" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre">Nombre de la categoría <b>*</b></label>
                                    <input type="text" name="nombre" id="nombre" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="<?php echo $VIEWS; ?>/categorias_gastos/" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Registrar categoría</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include('../usuarios/layout/parte2.php');
?>
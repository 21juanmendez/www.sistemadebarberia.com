<?php
include('../usuarios/layout/parte1.php');
?>
<!--codigo html-->
<div class="container-fluid">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><b>CREAR NUEVO SERVICIO</b></h3>
        </div>
        <div class="card-body">
            <form action="<?php echo $URL ?>/app/controllers/servicios/controller_create.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Nombre del Servicio</label>
                                    <input type="text" name="nombre_servicio" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Precio</label>
                                    <input type="number" id="precio" name="precio" class="form-control" step="0.01" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Descripción</label>
                                    <textarea name="descripcion" class="form-control" rows="2" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Seleccione la imagen del servicio</label>
                            <input name="file" class="form-control" type="file" id="file" required>
                            <center>
                                <output id="list">

                                </output>
                            </center>
                        </div>
                    </div>
                </div>
                <center>
                    <button class="btn btn-primary" type="submit">Registrar</button>
                    <a href="<?php echo $VIEWS ?>/servicios" class="btn btn-secondary">Cancelar</a>
                </center>
            </form>
        </div>
    </div>
</div>
<?php
include('../usuarios/layout/parte2.php');
?>
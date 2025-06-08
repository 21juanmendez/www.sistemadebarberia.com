<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/servicios/controller_read.php');
?>
<!--codigo html-->
<div class="container-fluid">
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title"><b>ACTUALIZAR SERVICIO</b></h3>
        </div>
        <div class="card-body">
            <form action="<?php echo $URL ?>/app/controllers/servicios/controller_update.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="id_servicio" value="<?php echo $id_servicio?>" hidden >
                                    <label>Nombre del Servicio</label>
                                    <input value="<?php echo $nombre_servicio ?>" type="text" name="nombre_servicio" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Precio</label>
                                    <input value="<?php echo $precio ?>" type="number" id="precio" name="precio" class="form-control" step="0.01" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Puntos por servicio</label>
                                    <input value="<?php echo $acumula_puntos ?>" type="text" id="acumula_puntos" name="acumula_puntos" class="form-control" required>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Descripción</label>
                                    <textarea name="descripcion" class="form-control" rows="2" required><?php echo $descripcion ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Seleccione la imagen del servicio</label>
                            <input name="file" class="form-control" type="file" id="file" >
                            <input name="imagen" type="text" value="<?php echo $imagen ?>" hidden>
                            <center>
                                <output id="list">
                                    <br>
                                    <img src="<?php echo $URL . "/public/imagenes/servicios/" . $imagen ?>" width="50%">
                                </output>
                            </center>
                        </div>
                    </div>
                </div>
                <center>
                    <button class="btn btn-success" type="submit">Actualizar</button>
                    <a href="<?php echo $VIEWS ?>/servicios" class="btn btn-secondary">Cancelar</a>
                </center>
            </form>
        </div>
    </div>
</div>
<?php
include('../usuarios/layout/parte2.php');
?>
<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/proveedores/controller_read.php');
?>
<!--codigo html-->
<div class="container-fluid">
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title"><b>ACTUALIZAR PROVEEDOR</b></h3>
        </div>
        <div class="card-body">
            <form action="<?php echo $URL ?>/app/controllers/proveedores/controller_update.php" method="post">
                <input type="hidden" name="id_proveedor" value="<?php echo $id_proveedor ?>">
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nombre de la Empresa</label>
                            <input type="text" name="nombre_empresa" class="form-control" value="<?php echo $nombre_empresa ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nombre del Contacto</label>
                            <input type="text" name="nombre_contacto" class="form-control" value="<?php echo $nombre_contacto ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $email ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Teléfono</label>
                            <input type="tel" name="telefono" class="form-control" value="<?php echo $telefono ?>" maxlength="15">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Dirección</label>
                            <textarea name="direccion" class="form-control" rows="3"><?php echo $direccion ?></textarea>
                        </div>
                    </div>
                </div>
                <center>
                    <button class="btn btn-success" type="submit">Actualizar</button>
                    <a href="<?php echo $VIEWS ?>/proveedores" class="btn btn-secondary">Cancelar</a>
                </center>
            </form>
        </div>
    </div>
</div>
<?php
include('../usuarios/layout/parte2.php');
?>
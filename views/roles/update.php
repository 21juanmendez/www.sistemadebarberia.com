<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/roles/controller_read.php');
include('mensaje.php');

?>
<!--codigo html-->
<div class="container-fluid">
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title"><b>EDITAR ROL</b></h3>
        </div>
        <div class="card-body">
            <form class="row g-3" action="<?php echo $URL ?>/app/controllers/roles/controller_update.php" method="post">
        
                <input type="hidden" value="<?php echo $id_rol ?>" name="id_rol" class="form-control" required>

                <div class="col-md-6">
                    <label>Nombre de rol</label>
                    <input value="<?php echo $nombre?>" name="nombre" type="text" class="form-control" required>
                </div>
                <center>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success"> Actualizar</button>
                        <a href="<?php echo $URL ?>/views/roles" class="btn btn-secondary"> Cancelar</a>
                    </div>
                </center>
            </form>
        </div>
    </div>
</div>
<?php
include('../usuarios/layout/parte2.php');
?>
<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/roles/controller_read.php');
include('mensaje.php');

?>
<!--codigo html-->
<div class="container-fluid">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"><b>VISUALIZAR ROL</b></h3>
        </div>
        <div class="card-body">
            <form class="row g-3" action="" method="post">
                <input type="hidden" value="<?php echo $id_rol ?>" name="id_rol" class="form-control" placeholder="Name" required>

                <div class="col-md-6">
                    <label>Nombre de rol</label>
                    <p><?php echo $nombre ?></p>
                </div>
                <center>
                    <div class="col-md-12">
                        <a href="<?php echo $URL ?>/views/roles" class="btn btn-secondary"> Regresar</a>
                    </div>
                </center>
            </form>
        </div>
    </div>
</div>
<?php
include('../usuarios/layout/parte2.php');
?>
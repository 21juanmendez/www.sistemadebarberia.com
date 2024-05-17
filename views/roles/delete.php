<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/roles/controller_read.php');
include('mensaje.php');

?>
<!--codigo html-->
<div class="container-fluid">
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title"><b>ELIMINAR ROL</b></h3>
        </div>
        <div class="card-body">
            <form class="row g-3" action="<?php echo $URL ?>/app/controllers/roles/controller_delete.php" method="post">

                <input type="hidden" value="<?php echo $id_rol ?>" name="id_rol" class="form-control" placeholder="Name" required>

                <div class="col-md-6">
                    <label>Nombre de rol</label>
                    <p><?php echo $nombre ?></p>
                </div>
                <center>
                    <div class="col-md-12">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Eliminar
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content modal-centered">
                                    <div class="modal-header" style="background-color: red;">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel"><b>Eliminar Rol<b></h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>¿Esta seguro de que desea eliminar este rol?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <center>
                                            <button type="submit" class="btn btn-danger">Aceptar</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
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
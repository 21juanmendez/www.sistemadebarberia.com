<?php
include('layout/parte1.php');
include('layout/mensaje.php');
include('../../app/controllers/usuarios/controller_read.php');
?>
<!--codigo html-->
<div class="container-fluid">
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title"><b>ELIMINAR USUARIO</b></h3>
        </div>
        <div class="card-body">
            <form class="row g-3" action="<?php echo $URL ?>/app/controllers/usuarios/controller_delete.php" method="post">

                <input type="text" value="<?php echo $usuario['id_usuario'] ?>" name="id_usuario" hidden>

                <div class="col-md-6">
                    <label>Nombre Completo</label>
                    <p><?php echo $nombre_completo?></p>
                </div>
                <div class="col-md-6">
                    <label>Correo Electronico</label>
                    <p><?php echo $email ?></p>
                </div>
                <div class="col-md-6">
                    <label for="validationDefault04" class="form-label">Telefono</label>
                    <p><?php echo $telefono ?></p>
                </div>
                <div class="col-md-6">
                    <label for="validationDefault04" class="form-label">Cargo</label>
                    <p><?php echo $cargo ?></p>
                </div>
                <div class="col-md-6">
                    <label>Fecha de registro</label>
                    <p><?php echo $fyh_creacion ?></p>
                </div>
                <div class="col-md-6">
                    <label>Fecha de actualizacion</label>
                    <p><?php echo $fyh_actualizacion ?></p>
                </div>
                <center>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Eliminar
                    </button>
                    <a href="<?php echo $VIEWS?>/usuarios/usuarios.php" class="btn btn-secondary">Cancelar</a>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: red;">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel"><b>Eliminar Usuario<b></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <p>¿Esta seguro de que desea eliminar a este usuario?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger">Aceptar</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </center>

            </form>
        </div>
    </div>
</div>
<?php
include('layout/parte2.php');
?>
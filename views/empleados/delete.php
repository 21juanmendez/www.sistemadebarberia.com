<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/empleados/controller_read.php');
include('../../app/controllers/empleados_servicios/controller_read.php');
?>
<!--codigo html-->
<div class="container-fluid">
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title"><b>ELIMINAR EMPLEADO</b></h3>
        </div>
        <div class="card-body">
            <form action="<?php echo $URL ?>/app/controllers/empleados/controller_delete.php" method="post">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Nombre del empleado</label>
                            <input name="id_empleado" value="<?php echo $id_empleado ?>" type="text" hidden>
                            <p><?php echo $nombre_empleado ?></p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Correo electronico</label>
                            <p><?php echo $email ?></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Direccion</label>
                            <p><?php echo $direccion ?></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">

                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Telefono</label>
                            <p><?php echo $telefono ?></p>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Dui</label>
                            <p><?php echo $dui ?></p>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Nit</label>
                            <p><?php echo $nit ?></p>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">

                        </div>
                    </div>
                </div>
                <center>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Eliminar
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content modal-centered">
                                <div class="modal-header" style="background-color: red;">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel"><b>Eliminar Servicio<b></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>¿Esta seguro de que desea eliminar a este empleado</p>
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
                    <a href="<?php echo $URL ?>/views/empleados" class="btn btn-secondary"> Cancelar</a>
                </center>
            </form>
        </div>
    </div>
</div>
<?php
include('../usuarios/layout/parte2.php');

?>
<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/empleados/controller_read.php'); //para leer los datos del empleado seleccionado
include('../../app/controllers/servicios/controller_servicios.php'); //para leer los datos de TODOS los servicios
include('../../app/controllers/empleados_servicios/controller_read.php'); //para leer los servicios del empleado seleccionado
include('mensaje.php');
?>
<!--codigo html-->
<div class="container-fluid">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><b>Agregar Servicios a <?php echo $nombre_empleado ?></b></h3>
        </div>
        <div class="card-body">
            <form action="<?php echo $URL ?>/app/controllers/empleados_servicios/controller_create.php" method="post" class="row align-items-center">
                <input type="hidden" name="id_empleado" value="<?php echo $id_empleado ?>">
                <?php foreach ($servicios as $servicio) { ?>
                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="id_servicios[]" value="<?php echo $servicio['id_servicio'] ?>" id="servicio<?php echo $servicio['id_servicio'] ?>">
                            <label class="form-check-label" for="servicio<?php echo $servicio['id_servicio'] ?>">
                                <?php echo $servicio['nombre_servicio'] ?>
                            </label>
                        </div>
                    </div>
                <?php } ?>
                <div class="col-md-12 mt-3">
                    <center>
                        <button type="submit" class="btn btn-primary">Agregar</button>
                        <a href="<?php echo $URL ?>/views/empleados/" class="btn btn-secondary">Regresar</a>
                    </center>
                </div>
            </form>
        </div>
    </div>

    <div class="card card-info">
        <div class="card-body" >
            <div class="row">
                <div class="col-md-12">
                    <table id="example" class="table table-striped table-hover table-borderless table-sm">
                        <thead class="table">
                            <tr>
                                <th scope="col">
                                    <center>#</center>
                                </th>
                                <th scope="col">
                                    <center>Servicios Agregados</center>
                                </th>
                                <th scope="col">
                                    <center>Accion</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador = 0;
                            foreach ($empleados_servicios as $empleado_servicio) {
                                $contador++;
                            ?>
                                <tr>
                                    <td>
                                        <center><?php echo $contador ?></center>
                                    </td>
                                    <td>
                                        <center><?php echo $empleado_servicio['nombre_servicio'] ?></center>
                                    </td>
                                    <td>
                                        <form action="<?php echo $URL ?>/app/controllers/empleados_servicios/controller_delete.php" method="post">
                                            <center>
                                                <input type="text" name="id_empleado" value="<?php echo $id_empleado ?>" hidden>
                                                <input type="text" name="id_empleado_servicio" value="<?php echo $empleado_servicio['id_empleado_servicio'] ?>" hidden>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                    <i class="bi bi-trash"></i>
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
                                                                <p>¿Esta seguro de que desea eliminar este servicio</p>
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
                                            </center>
                                        </form>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include('../usuarios/layout/parte2.php');

?>
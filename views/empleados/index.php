<?php
include('../usuarios/layout/parte1.php');
include('mensaje.php');
include('../../app/controllers/empleados_servicios/controller_empleados_servicios.php');
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><b>LISTADO DE EMPLEADOS</b></h3>
                </div>
                <div class="card-body">
                    <a href="<?php echo $VIEWS; ?>/empleados/create.php" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Agregar Empleado</a>
                    <br><br>
                    <div class="row">
                        <div class="col-md-12">
                            <table id="example6" class="table table-striped table-hover table-borderless">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">
                                            <center>#</center>
                                        </th>
                                        <th scope="col">
                                            <center>Nombre</center>
                                        </th>
                                        <th scope="col">
                                            <center>Servicios</center>
                                        </th>
                                        <th scope="col">
                                            <center>Acciones</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($empleados as $empleado) {
                                        $contador++;
                                    ?>
                                        <tr>
                                            <td>
                                                <center><?php echo $contador ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $empleado['nombre_empleado'] ?></center>
                                            </td>
                                            <td>
                                                <center>
                                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#serviciosModal<?php echo $empleado['id_empleado']; ?>">
                                                        <i class="bi bi-eye-fill"></i> Servicios
                                                    </button>
                                                </center>
                                            </td>
                                            <!-- Modal -->
                                            <div class="modal fade" id="serviciosModal<?php echo $empleado['id_empleado']; ?>" tabindex="-1" aria-labelledby="serviciosModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-info">
                                                            <h5 class="modal-title" id="exampleModalLabel">Servicios de <?php echo $empleado['nombre_empleado'] ?></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <ul>
                                                                <?php
                                                                $servicios_empleado = explode(',', $empleado['servicios']);
                                                                foreach ($servicios_empleado as $servicio) {
                                                                    echo "<li>$servicio</li>";
                                                                }
                                                                ?>
                                                            </ul>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <td>
                                                <center>
                                                    <a href="<?php echo $VIEWS; ?>/empleados_servicios/create.php?id_empleado=<?php echo $empleado['id_empleado']; ?>" class="btn btn-primary btn-sm">
                                                        <i class="bi bi-plus-lg"></i> Agregar Servicios
                                                    </a>
                                                    <a href="<?php echo $VIEWS; ?>/empleados/read.php?id_empleado=<?php echo $empleado['id_empleado']; ?>" class="btn btn-info btn-sm">
                                                        <i class="bi bi-eye-fill"></i> Ver Empleado
                                                    </a>
                                                    <a href="<?php echo $VIEWS; ?>/empleados/update.php?id_empleado=<?php echo $empleado['id_empleado']; ?>" class="btn btn-success btn-sm">
                                                        <i class="bi bi-pencil-square"></i> Editar Empleado
                                                    </a>
                                                    <a href="<?php echo $VIEWS; ?>/empleados/delete.php?id_empleado=<?php echo $empleado['id_empleado']; ?>" class="btn btn-danger btn-sm">
                                                        <i class="bi bi-trash-fill"></i> Eliminar Empleado
                                                    </a>
                                                </center>
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
    </div>
</div>

<?php
include('../usuarios/layout/parte2.php');
?>
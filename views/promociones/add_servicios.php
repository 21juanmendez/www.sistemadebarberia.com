<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/promociones/controller_read.php'); //para leer los datos de la promoción seleccionada
include('../../app/controllers/servicios/controller_servicios.php'); //para leer los datos de TODOS los servicios
include('../../app/controllers/promociones_servicios/controller_read.php'); //para leer los servicios de la promoción seleccionada
include('mensaje.php');
?>
<!--codigo html-->
<div class="container-fluid">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><b>Agregar Servicios a la Promoción: <?php echo $nombre ?></b></h3>
        </div>
        <div class="card-body">
            <form action="<?php echo $URL ?>/app/controllers/promociones_servicios/controller_create.php" method="post" class="row align-items-center">
                <input type="hidden" name="id_promocion" value="<?php echo $id_promocion ?>">
                <?php 
                // Crear un array con los IDs de los servicios de la promoción
                $servicios_promocion_ids = array_column($promociones_servicios, 'id_servicio');
                
                foreach ($servicios as $servicio) { 
                    $checked = in_array($servicio['id_servicio'], $servicios_promocion_ids) ? 'checked' : '';
                    $disabled = in_array($servicio['id_servicio'], $servicios_promocion_ids) ? 'disabled' : '';
                ?>
                    <div class="col-md-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="id_servicios[]" value="<?php echo $servicio['id_servicio'] ?>" id="servicio<?php echo $servicio['id_servicio'] ?>" <?php echo $checked; ?> <?php echo $disabled; ?>>
                            <label class="form-check-label" for="servicio<?php echo $servicio['id_servicio'] ?>">
                                <?php echo $servicio['nombre_servicio'] ?> - $<?php echo $servicio['precio'] ?>
                            </label>
                        </div>
                    </div>
                <?php } ?>
                <div class="col-md-12 mt-3">
                    <center>
                        <button type="submit" class="btn btn-primary">Agregar Servicios</button>
                        <a href="<?php echo $URL ?>/views/promociones/" class="btn btn-secondary">Regresar</a>
                    </center>
                </div>
            </form>
        </div>
    </div>

    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"><b>Servicios incluidos en la promoción</b></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table id="example" class="table table-striped table-hover table-borderless table-sm">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">
                                    <center>#</center>
                                </th>
                                <th scope="col">
                                    <center>Servicio</center>
                                </th>
                                <th scope="col">
                                    <center>Precio</center>
                                </th>
                                <th scope="col">
                                    <center>Acción</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador = 0;
                            $total_precio = 0;
                            foreach ($promociones_servicios as $promocion_servicio) {
                                $contador++;
                                $total_precio += $promocion_servicio['precio'];
                            ?>
                                <tr>
                                    <td>
                                        <center><?php echo $contador ?></center>
                                    </td>
                                    <td>
                                        <center><?php echo $promocion_servicio['nombre_servicio'] ?></center>
                                    </td>
                                    <td>
                                        <center>$<?php echo number_format($promocion_servicio['precio'], 2) ?></center>
                                    </td>
                                    <td>
                                        <form action="<?php echo $URL ?>/app/controllers/promociones_servicios/controller_delete.php" method="post">
                                            <center>
                                                <input type="hidden" name="id_promocion" value="<?php echo $id_promocion ?>">
                                                <input type="hidden" name="id_servicio" value="<?php echo $promocion_servicio['id_servicio'] ?>">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal<?php echo $promocion_servicio['id_servicio']; ?>">
                                                    <i class="bi bi-trash"></i>
                                                    Eliminar
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="modal<?php echo $promocion_servicio['id_servicio']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel<?php echo $promocion_servicio['id_servicio']; ?>" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content modal-centered">
                                                            <div class="modal-header" style="background-color: red;">
                                                                <h1 class="modal-title fs-5" id="modalLabel<?php echo $promocion_servicio['id_servicio']; ?>"><b>Eliminar Servicio</b></h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>¿Está seguro de que desea eliminar este servicio de la promoción?</p>
                                                                <p><strong>Servicio:</strong> <?php echo $promocion_servicio['nombre_servicio'] ?></p>
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
                            <?php if ($contador > 0): ?>
                                <tr class="table-info">
                                    <td colspan="2"><center><strong>TOTAL</strong></center></td>
                                    <td><center><strong>$<?php echo number_format($total_precio, 2) ?></strong></center></td>
                                    <td></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <?php if ($contador == 0): ?>
                        <div class="alert alert-warning text-center">
                            <i class="bi bi-exclamation-triangle"></i>
                            <strong>No hay servicios agregados a esta promoción</strong>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include('../usuarios/layout/parte2.php');
?>
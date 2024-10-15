<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/ventas/controller_ventas.php');
include('mensaje.php');
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><b>HISTORIAL DE VENTAS</b></h3>
                </div>
                <div class="card-body">
                    <a href="<?php echo $URL; ?>/app/controllers/ventas/controller_create_temporal.php" class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i> Registrar nueva venta
                    </a>

                    <br><br>
                    <div class="row">
                        <div class="col-md-12">
                            <table id="tb_ventas" class="table table-striped table-borderless table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="text-align: center;">#</th>
                                        <th style="text-align: center;">Vendedor</th>
                                        <th style="text-align: center;">Subtotal productos</th>
                                        <th style="text-align: center;">Subtotal servicios</th>
                                        <th style="text-align: center;">Total de venta</th>
                                        <th style="text-align: center;">Fecha de Creacion</th>
                                        <th style="text-align: center;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($ventas as $venta) {
                                        $contador++;
                                    ?>
                                        <tr>
                                            <td>
                                                <center><?php echo $contador ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $venta['nombre_completo'] ?></center>
                                            </td>
                                            <td>
                                                <center>$<?php echo $venta['subtotal_productos'] ?></center>
                                            </td>
                                            <td>
                                                <center>$<?php echo $venta['subtotal_servicios'] ?></center>
                                            </td>
                                            <td>
                                                <center>$<?php echo $venta['total_venta'] ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $venta['fyh_creacion'] ?></center>
                                            </td>
                                            <td>
                                                <center>
                                                    <!-- boton para llamar a modal -->
                                                    <a href="<?php echo $VIEWS ?>/ventas/verVenta.php?id_venta=<?php echo $venta['id_venta'] ?>" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                                                    <a href="<?php echo $VIEWS ?>/ventas/factura.php?id_venta=<?php echo $venta['id_venta'] ?>" target="_blank" class="btn btn-warning btn-sm"><i class="bi bi-printer"></i></a>
                                                    <!-- boton para llamar a modal -->
                                                    <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal_eliminar_venta" onclick="$('#id_venta').val(<?php echo $venta['id_venta'] ?>)"><i class="bi bi-trash"></i></a>
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
<!-- Modal centrado en la pantalla para confirmar eliminacion de venta -->
<div class="modal fade" id="modal_eliminar_venta" tabindex="-1" aria-labelledby="modal_eliminar_venta" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="<?php echo $URL ?>/app/controllers/ventas/controller_delete.php" method="POST">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="modal_eliminar_venta">Eliminar Venta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <input type="hidden" name="id_venta" id="id_venta">
                <div class="modal-body
                ">
                    <p>¿Está seguro que desea eliminar la venta? </p>
                    <span class="text-danger"><i class="bi bi-info-circle"></i> Esta acción devolvera los productos al stock y no se podrá recuperar la venta</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
include('../usuarios/layout/parte2.php');

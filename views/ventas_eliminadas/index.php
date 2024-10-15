<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/ventas_eliminadas/ventas_eliminadas.php');
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><b>HISTORIAL DE VENTAS ELIMINADAS</b></h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="tb_ventas_delete" class="table table-striped table-borderless table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="text-align: center;">Eliminada por</th>
                                        <th style="text-align: center;">Venta realizada por</th>
                                        <th style="text-align: center;">Subtotal productos</th>
                                        <th style="text-align: center;">Subtotal servicios</th>
                                        <th style="text-align: center;">Total de venta</th>
                                        <th style="text-align: center;">Fecha de eliminación</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($ventas_eliminadas as $venta) {
                                    ?>
                                        <tr>
                                            <td>
                                                <center><?php echo $venta['nombre_completo'] ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $venta['vendedor'] ?></center>
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
                                                <center><?php echo $venta['fyh_eliminacion'] ?></center>
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

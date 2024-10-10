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
                                                    <a href="#" class="btn btn-info btn-sm"><i class="bi bi-eye-fill"></i></a>
                                                    <a href="#" class="btn btn-warning btn-sm"><i class="bi bi-printer"></i></a>
                                                    <a href="#" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></a>
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

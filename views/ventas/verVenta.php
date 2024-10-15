<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/ventas/controller_factura.php');
?>
<!-- ver detalle de venta -->

<div class="container-fluid">
    <div class="card card-info">
        <div class="card-header pt-1 pb-1">
            <div class="row">
                    <div class="col-md-6 mt-2">
                        <h5><b>DETALLE DE VENTA</b></h5>
                    </div>
                    <div class="col-md-6">
                        <a href="<?php echo $VIEWS ?>/ventas/factura.php?id_venta=<?php echo $id_venta; ?>" target="_blank" class="btn btn-info float-right">
                            <i class="bi bi-printer"></i> Imprimir
                        </a>
                    </div>
            </div>
        </div>
        <div class="card-body p-3">
            <div class="row">
                <div class="col-md-6">
                    <h5><strong>Vendedor:</strong> <?php echo htmlspecialchars($nombre_vendedor); ?></h5>
                </div>
                <div class="col-md-6">
                    <h5><strong>Fecha de Venta:</strong> <?php echo htmlspecialchars($fecha_venta); ?></h5>
                </div>
                <br>
                <br>
                <h4>Productos Vendidos</h4>
                <table class="table table-hover tb_ventass">
                    <thead class="table-primary">
                        <tr>
                            <th>Nombre del Producto</th>
                            <th>Descripción</th>
                            <th>Precio de Venta</th>
                            <th>Cantidad</th>
                            <th>Precio Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($productos_vendidos) {
                            foreach ($productos_vendidos as $producto) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($producto['nombre_producto']); ?></td>
                                    <td><?php echo htmlspecialchars($producto['descripcion']); ?></td>
                                    <td>$<?php echo htmlspecialchars($producto['precio_venta']); ?></td>
                                    <td><?php echo htmlspecialchars($producto['cantidad']); ?></td>
                                    <td>$<?php echo htmlspecialchars($producto['precio']); ?></td>
                                </tr>
                            <?php }
                        } else {
                            ?>
                            <tr>
                                <td colspan="5" style="text-align:center;">No se han vendido productos</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <h4 class="mt-4">Servicios Vendidos</h4>
                <table class="table table-hover tb_ventass">
                    <thead class="table-primary">
                        <tr>
                            <th>Nombre del Servicio</th>
                            <th>Descripción</th>
                            <th>Precio de Venta</th>
                            <th>Cantidad</th>
                            <th>Precio Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($servicios_vendidos) {
                            foreach ($servicios_vendidos as $servicio) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($servicio['nombre_servicio']); ?></td>
                                    <td><?php echo htmlspecialchars($servicio['descripcion']); ?></td>
                                    <td>$<?php echo htmlspecialchars($servicio['precio_venta']); ?></td>
                                    <td><?php echo htmlspecialchars($servicio['cantidad']); ?></td>
                                    <td>$<?php echo htmlspecialchars($servicio['precio']); ?></td>
                                </tr>
                            <?php }
                        } else {
                            ?>
                            <tr>
                                <td colspan="5" style="text-align:center;">No se han vendido servicios</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <br>
                <br>
                <h4 class="mt-4">Resumen de la Venta</h4>
                <table class="table table-hover tb_ventass">
                    <thead class="table-success">
                        <tr>
                            <th>Subtotal Productos</th>
                            <th>Subtotal Servicios</th>
                            <th>Total de Venta</th>
                            <th>Total Pagado</th>
                            <th>Cambio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>$<?php echo htmlspecialchars($subtotal_productos); ?></td>
                            <td>$<?php echo htmlspecialchars($subtotal_servicios); ?></td>
                            <td>$<?php echo htmlspecialchars($total_venta); ?></td>
                            <td>$<?php echo htmlspecialchars($total_pago); ?></td>
                            <td>$<?php echo htmlspecialchars($cambio); ?></td>
                        </tr>
                    </tbody>
                </table> <!-- Close the table tag here -->
            </div>
        </div>
        <div class="card-footer text-center" style="background-color: transparent;">
            <a href="<?php echo $VIEWS ?>/ventas" class="btn btn-info">Regresar</a>
        </div>
    </div>
</div>


<?php
include('../usuarios/layout/parte2.php');

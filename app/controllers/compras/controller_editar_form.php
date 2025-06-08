<?php
include("../../config.php");

if (isset($_GET['id'])) {
    $id_compra = $_GET['id'];

    // Obtener información de la compra
    $sql_compra = "SELECT c.*, p.nombre_empresa 
                   FROM tb_compras c
                   INNER JOIN tb_proveedores p ON c.id_proveedor = p.id_proveedor
                   WHERE c.id_compra = :id_compra";
    $query_compra = $pdo->prepare($sql_compra);
    $query_compra->bindParam(':id_compra', $id_compra);
    $query_compra->execute();
    $compra = $query_compra->fetch(PDO::FETCH_ASSOC);

    // Obtener detalles de la compra
    $sql_detalle = "SELECT dc.*, pr.nombre_producto, pr.codigo 
                    FROM tb_detalle_compras dc
                    INNER JOIN tb_productos pr ON dc.id_producto = pr.id_producto
                    WHERE dc.id_compra = :id_compra";
    $query_detalle = $pdo->prepare($sql_detalle);
    $query_detalle->bindParam(':id_compra', $id_compra);
    $query_detalle->execute();
    $detalles = $query_detalle->fetchAll(PDO::FETCH_ASSOC);

    if ($compra) {
?>
        <form id="formEditarCompra" action="../../app/controllers/compras/controller_update.php" method="POST">
            <input type="hidden" name="id_compra" value="<?php echo $compra['id_compra']; ?>">
            <input type="hidden" name="estado_anterior" value="<?php echo $compra['estado']; ?>">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label><strong>Proveedor:</strong></label>
                        <p class="form-control-plaintext"><?php echo $compra['nombre_empresa']; ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label><strong>Fecha de Compra:</strong></label>
                        <p class="form-control-plaintext"><?php echo date('d/m/Y', strtotime($compra['fecha_compra'])); ?></p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="edit_estado">Estado <span class="text-danger">*</span></label>
                        <select name="estado" id="edit_estado" class="form-control" required>
                            <option value="" selected disabled>Pendiente</option>
                            <option value="en curso" <?php echo ($compra['estado'] == 'en_curso') ? 'selected' : ''; ?>>En Curso</option>
                            <option value="completada" <?php echo ($compra['estado'] == 'completada') ? 'selected' : ''; ?>>Completada</option>
                            <option value="cancelada" <?php echo ($compra['estado'] == 'cancelada') ? 'selected' : ''; ?>>Cancelada</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label><strong>Total de Compra:</strong></label>
                        <p class="form-control-plaintext">$<?php echo number_format($compra['total_compra'], 2); ?></p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h5>Productos de la Compra</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-secondary">
                                <tr>
                                    <th>Código</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unitario</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($detalles as $detalle) { ?>
                                    <tr>
                                        <td><?php echo $detalle['codigo']; ?></td>
                                        <td><?php echo $detalle['nombre_producto']; ?></td>
                                        <td><?php echo $detalle['cantidad']; ?></td>
                                        <td>$<?php echo number_format($detalle['precio_unitario'], 2); ?></td>
                                        <td>$<?php echo number_format($detalle['subtotal'], 2); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-end">Total:</th>
                                    <th>$<?php echo number_format($compra['total_compra'], 2); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">

            </div>

            <div class="modal-footer">
                <small class="form-text text-danger" style="font-size: medium;">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    Una vez que cambie el estado de esta compra, <strong>no podrá volver a modificarlo</strong>.
                </small>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Actualizar Estado</button>
            </div>
        </form>
<?php
    } else {
        echo '<div class="alert alert-danger">Compra no encontrada</div>';
    }
} else {
    echo '<div class="alert alert-danger">ID de compra no proporcionado</div>';
}
?>
<?php
include("../../config.php");

if (isset($_GET['id'])) {
    $id_compra = $_GET['id'];
    
    // Obtener información de la compra
    $sql_compra = "SELECT c.*, p.nombre_empresa, p.nombre_contacto, p.telefono, u.nombre_completo 
                   FROM tb_compras c
                   INNER JOIN tb_proveedores p ON c.id_proveedor = p.id_proveedor
                   INNER JOIN tb_usuarios u ON c.id_usuario = u.id_usuario
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
        // Determinar clase de badge según el estado
        $badge_class = '';
        switch($compra['estado']) {
            case 'pendiente':
                $badge_class = 'bg-warning';
                break;
            case 'parcial':
                $badge_class = 'bg-info';
                break;
            case 'completada':
                $badge_class = 'bg-success';
                break;
            case 'cancelada':
                $badge_class = 'bg-danger';
                break;
        }
?>
        <div class="row">
            <div class="col-md-6">
                <h6><strong>Información General</strong></h6>
                <table class="table table-borderless">
                    <tr>
                        <td><strong>ID Compra:</strong></td>
                        <td><?php echo $compra['id_compra']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Fecha:</strong></td>
                        <td><?php echo date('d/m/Y', strtotime($compra['fecha_compra'])); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Estado:</strong></td>
                        <td><span class="badge <?php echo $badge_class; ?>"><?php echo ucfirst($compra['estado']); ?></span></td>
                    </tr>
                    <tr>
                        <td><strong>Usuario:</strong></td>
                        <td><?php echo $compra['nombre_completo']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Total:</strong></td>
                        <td><strong>$<?php echo number_format($compra['total_compra'], 2); ?></strong></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h6><strong>Información del Proveedor</strong></h6>
                <table class="table table-borderless">
                    <tr>
                        <td><strong>Empresa:</strong></td>
                        <td><?php echo $compra['nombre_empresa']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Contacto:</strong></td>
                        <td><?php echo $compra['nombre_contacto']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Teléfono:</strong></td>
                        <td><?php echo $compra['telefono']; ?></td>
                    </tr>
                </table>
            </div>
        </div>
        
        <hr>
        
        <h6><strong>Detalle de Productos</strong></h6>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
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
                    <tr class="table-info">
                        <th colspan="4" class="text-end">Total:</th>
                        <th>$<?php echo number_format($compra['total_compra'], 2); ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        <div class="mt-3">
            <small class="text-muted">
                <strong>Fecha de registro:</strong> <?php echo date('d/m/Y H:i:s', strtotime($compra['fyh_creacion'])); ?>
            </small>
        </div>
<?php
    } else {
        echo '<div class="alert alert-danger">Compra no encontrada</div>';
    }
} else {
    echo '<div class="alert alert-danger">ID de compra no proporcionado</div>';
}
?>
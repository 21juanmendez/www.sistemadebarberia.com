<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/gastos/controller_read.php');
include('../../app/controllers/categorias_gastos/controller_categorias.php');

// Obtener el ID del gasto a eliminar
$id_gasto = $_GET['id_gasto'];

// Consultar los datos del gasto
$sql = "SELECT g.*, c.nombre as categoria_nombre 
        FROM tb_gastos g 
        INNER JOIN tb_categorias_gastos c ON g.id_categoria_gasto = c.id_categoria_gasto 
        WHERE g.id_gasto = '$id_gasto'";
$query = $pdo->prepare($sql);
$query->execute();
$gastos = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($gastos as $gasto) {
    $id_categoria_gasto = $gasto['id_categoria_gasto'];
    $categoria_nombre = $gasto['categoria_nombre'];
    $descripcion = $gasto['descripcion'];
    $monto = $gasto['monto'];
    $fecha_gasto = $gasto['fecha_gasto'];
    $fyh_creacion = $gasto['fyh_creacion'];
}

//include('mensaje.php');
?>
<!--codigo html-->
<div class="container-fluid">
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title"><b>ELIMINAR GASTO</b></h3>
        </div>
        <div class="card-body">
            <form action="<?php echo $URL ?>/app/controllers/gastos/controller_delete.php" method="post">
                <input value="<?php echo $id_gasto ?>" type="text" name="id_gasto" hidden>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Categoría</label>
                                    <p><?php echo $categoria_nombre ?></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Monto</label>
                                    <p>$<?php echo number_format($monto, 2) ?></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fecha del gasto</label>
                                    <p><?php echo date('d/m/Y', strtotime($fecha_gasto)) ?></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Descripción</label>
                                    <p><?php echo $descripcion ?></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fecha de creación</label>
                                    <p><?php echo date('d/m/Y H:i', strtotime($fyh_creacion)) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <center>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <i class="bi bi-trash3-fill"></i> Eliminar
                    </button>
                    <a href="<?php echo $VIEWS ?>/gastos" class="btn btn-secondary">
                        <i class="bi bi-x-circle-fill"></i> Cancelar
                    </a>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #dc3545; color: white;">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                        <i class="bi bi-exclamation-triangle-fill"></i> <b>Eliminar Gasto</b>
                                    </h1>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center">
                                        <i class="bi bi-exclamation-triangle-fill text-warning" style="font-size: 3rem;"></i>
                                        <h5 class="mt-3">¿Está seguro de que desea eliminar este gasto?</h5>
                                        <p class="text-muted">Esta acción no se puede deshacer.</p>
                                        <div class="alert alert-info">
                                            <strong>Gasto a eliminar:</strong><br>
                                            <strong>Categoría:</strong> <?php echo $categoria_nombre ?><br>
                                            <strong>Monto:</strong> $<?php echo number_format($monto, 2) ?><br>
                                            <strong>Fecha:</strong> <?php echo date('d/m/Y', strtotime($fecha_gasto)) ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger">
                                        <i class="bi bi-trash3-fill"></i> Sí, Eliminar
                                    </button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        <i class="bi bi-x-circle"></i> Cancelar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </center>
            </form>
        </div>
    </div>
</div>
<?php
include('../usuarios/layout/parte2.php');
?>
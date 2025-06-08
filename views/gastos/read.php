<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/gastos/controller_read.php');
//include('mensaje.php');
?>
<!--codigo html-->
<div class="container-fluid">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"><b>VISUALIZAR GASTO</b></h3>
        </div>
        <div class="card-body">
            <form action="" method="">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>ID del Gasto</label>
                                    <p><strong>#<?php echo str_pad($id_gasto, 4, '0', STR_PAD_LEFT) ?></strong></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Fecha del Gasto</label>
                                    <p><?php echo date('d/m/Y', strtotime($fecha_gasto)) ?></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Categoría</label>
                                    <p><?php echo $categoria_nombre ?></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Monto</label>
                                    <p><span class="badge bg-success fs-6">$<?php echo number_format($monto, 2) ?></span></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Descripción</label>
                                    <div class="border rounded p-3 bg-light">
                                        <p class="mb-0"><?php echo nl2br(htmlspecialchars($descripcion)) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Fecha de Registro</label>
                                    <p><?php echo date('d/m/Y H:i:s', strtotime($fyh_creacion)) ?></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                            <div class="form-group">
                                    <label>Fecha de Actualización</label>
                                    <p><?php echo $fyh_actualizacion ? date('d/m/Y H:i:s', strtotime($fyh_actualizacion)) : 'Sin actualizar'; ?></p>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Estado</label>
                                    <p><span class="badge bg-primary">Registrado</span></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tipo de Transacción</label>
                                    <p><span class="badge bg-danger"><i class="bi bi-arrow-down"></i> Egreso</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <center>
                    <br>
                    <a href="<?php echo $VIEWS ?>/gastos" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Regresar
                    </a>
                    <a href="<?php echo $VIEWS ?>/gastos/update.php?id_gasto=<?php echo $id_gasto ?>" class="btn btn-success">
                        <i class="bi bi-pencil-square"></i> Editar
                    </a>
                    <a href="<?php echo $VIEWS ?>/gastos/delete.php?id_gasto=<?php echo $id_gasto ?>" class="btn btn-danger">
                        <i class="bi bi-trash-fill"></i> Eliminar
                    </a>
                </center>
            </form>
        </div>
    </div>
</div>
<?php
include('../usuarios/layout/parte2.php');
?>
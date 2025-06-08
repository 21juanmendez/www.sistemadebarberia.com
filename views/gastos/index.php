<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/gastos/controller_gastos.php');
include('mensaje.php');
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><b>LISTADO DE GASTOS</b></h3>
                </div>
                <div class="card-body">
                    <a href="<?php echo $VIEWS; ?>/gastos/create.php" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Registrar nuevo gasto</a>
                    <br><br>
                    <div class="row">
                        <div class="col-md-12">
                            <table id="tb_gastos" class="table table-striped table-borderless table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="text-align: center;">#</th>
                                        <th style="text-align: center;">Categoria</th>
                                        <th style="text-align: center;">Descripción</th>
                                        <th style="text-align: center;">Monto</th>
                                        <th style="text-align: center;">Fecha</th>
                                        <th style="text-align: center;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($gastos as $gasto) {
                                        $contador++;
                                    ?>
                                        <tr>
                                            <td>
                                                <center><?php echo $contador ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $gasto['categoria'] ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $gasto['descripcion'] ?></center>
                                            </td>
                                            <td>
                                                <center>
                                                    <span class="badge bg-success text-white p-2">
                                                        $<?php echo number_format($gasto['monto'], 2) ?>
                                                    </span>
                                                </center>
                                            </td>
                                            <td>
                                                <center><?php echo date('d/m/Y', strtotime($gasto['fecha_gasto'])) ?></center>
                                            </td>
                                            <td>
                                                <center>
                                                    <a href="<?php echo $VIEWS ?>/gastos/read.php?id_gasto=<?php echo $gasto['id_gasto'] ?>" class="btn btn-info btn-sm"><i class="bi bi-eye-fill"></i></a>
                                                    <a href="<?php echo $VIEWS ?>/gastos/update.php?id_gasto=<?php echo $gasto['id_gasto'] ?>" class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></a>
                                                    <a href="<?php echo $VIEWS ?>/gastos/delete.php?id_gasto=<?php echo $gasto['id_gasto'] ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></a>
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
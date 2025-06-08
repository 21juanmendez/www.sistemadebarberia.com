<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/categorias_gastos/controller_categorias.php');
include('mensaje.php');
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><b>LISTADO DE CATEGORÍAS DE GASTOS</b></h3>
                </div>
                <div class="card-body">
                    <a href="<?php echo $VIEWS; ?>/categorias_gastos/create.php" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Registrar nueva categoría</a>
                    <br><br>
                    <div class="row">
                        <div class="col-md-12">
                            <table id="example4" class="table table-striped table-hover table-borderless">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">
                                            <center>#</center>
                                        </th>
                                        <th>
                                            <center>Nombre</center>
                                        </th>
                                        <th>
                                            <center>Fecha de registro</center>
                                        </th>
                                        <th>
                                            <center>Fecha de actualización</center>
                                        </th>
                                        <th>
                                            <center>Acciones</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($lista_categorias_gastos as $categoria_gasto){
                                        $contador++;
                                    ?>
                                        <tr>
                                            <td>
                                                <center><?php echo $contador ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $categoria_gasto['nombre'] ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $categoria_gasto['fyh_creacion'] ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $categoria_gasto['fyh_actualizacion'] ? $categoria_gasto['fyh_actualizacion'] : 'Sin actualizar' ?></center>
                                            </td>
                                            <td>
                                                <center>
                                                    <a href="<?php echo $VIEWS; ?>/categorias_gastos/read.php?id_categoria_gasto=<?php echo $categoria_gasto['id_categoria_gasto']; ?>" class="btn btn-info btn-sm"><i class="bi bi-eye-fill"></i></a>
                                                    <a href="<?php echo $VIEWS; ?>/categorias_gastos/update.php?id_categoria_gasto=<?php echo $categoria_gasto['id_categoria_gasto']; ?>" class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></a>
                                                    <a href="<?php echo $VIEWS; ?>/categorias_gastos/delete.php?id_categoria_gasto=<?php echo $categoria_gasto['id_categoria_gasto']; ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></a>
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
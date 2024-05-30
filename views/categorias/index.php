<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/roles/controller_roles.php');
include('../../app/controllers/categorias/controller_categorias.php');
include('mensaje.php');
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><b>LISTADO DE CATEGORIAS</b></h3>
                </div>
                <div class="card-body">
                    <a href="<?php echo $VIEWS; ?>/categorias/create.php" class="btn btn-primary"><i class="bi bi-plus-lg"></i>Registrar nueva categoria</a>
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
                                            <center>Fecha de actualizacion</center>
                                        </th>
                                        <th>
                                            <center>Acciones</center>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($lista_categorias as $categoria){
                                        $contador++;
                                    ?>
                                        <tr>
                                            <td>
                                                <center><?php echo $contador ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $categoria['nombre'] ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $categoria['fyh_creacion'] ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $categoria['fyh_actualizacion'] ?></center>
                                            </td>
                                            <td>
                                                <center>
                                                    <a href="<?php echo $VIEWS; ?>/categorias/read.php?id_categoria=<?php echo $categoria['id_categoria']; ?>" class="btn btn-info btn-sm"<i class="bi bi-eye-fill"></i></a>
                                                    <a href="<?php echo $VIEWS; ?>/categorias/update.php?id_categoria=<?php echo $categoria['id_categoria']; ?>" class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></a>
                                                    <a href="<?php echo $VIEWS; ?>/categorias/delete.php?id_categoria=<?php echo $categoria['id_categoria']; ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></a>
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
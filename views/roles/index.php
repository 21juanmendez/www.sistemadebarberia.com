<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/roles/controller_roles.php');
include('mensaje.php');
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><b>LISTADO DE ROLES</b></h3>
                </div>
                <div class="card-body">
                    <a href="<?php echo $VIEWS; ?>/roles/create.php" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Registrar nuevo rol</a>
                    <br><br>
                    <div class="row">
                        <div class="col-md-12">
                            <table id="example1" class="table table-striped table-hover table-borderless">

                                <thead class="table-dark">

                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Fecha de registro</th>
                                        <th scope="col">Fecha de actualizacion</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($roles as $rol) {
                                        $contador += 1;
                                    ?>
                                        <tr>
                                            <td><?php echo $contador; ?></td>
                                            <td><?php echo $rol['nombre']; ?></td>
                                            <td><?php echo $rol['fyh_creacion']; ?></td>
                                            <td><?php echo $rol['fyh_actualizacion']; ?></td>
                                            <td>
                                                <center>
                                                    <a href="<?php echo $VIEWS; ?>/roles/read.php?id_rol=<?php echo $rol['id_rol']; ?>" class="btn btn-info btn-sm"><i class="bi bi-eye-fill"></i></a>
                                                    <a href="<?php echo $VIEWS; ?>/roles/update.php?id_rol=<?php echo $rol['id_rol']; ?>" class="btn btn-success  btn-sm"><i class="bi bi-pencil-square"></i><a>
                                                    <a href="<?php echo $VIEWS; ?>/roles/delete.php?id_rol=<?php echo $rol['id_rol']; ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></a>
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
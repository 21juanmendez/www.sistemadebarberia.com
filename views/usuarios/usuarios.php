<?php
include('layout/parte1.php');
include('../../app/controllers/usuarios/controller_usuarios.php');
include('layout/mensaje.php');
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><b>LISTADO DE USUARIOS</b></h3>
                </div>
                <div class="card-body">
                    <a href="<?php echo $VIEWS; ?>/usuarios/create.php" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Registrar nuevo usuario</a>
                    <br><br>    
                    <div class="row">
                        <div class="col-md-12">
                            <table id="example2" class="table table-striped table-hover table-borderless">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nombre completo</th>
                                        <th scope="col">Correo Electronico</th>
                                        <th scope="col">Cargo</th>
                                        <th scope="col">Telefono</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($usuarios as $usuario) {
                                        $contador += 1;
                                    ?>
                                        <tr>
                                            <td><?php echo $contador; ?></td>
                                            <td><?php echo $usuario['nombre_completo']; ?></td>
                                            <td><?php echo $usuario['email']; ?></td>
                                            <td><?php echo $usuario['nombre_rol']; ?></td>
                                            <td><?php echo $usuario['telefono']; ?></td>
                                            <td>
                                                <a href="<?php echo $VIEWS?>/usuarios/read.php?id_usuario=<?php echo $usuario['id_usuario'];?>" class="btn btn-info btn-sm"><i class="bi bi-eye-fill"></i></a>
                                                <a href="<?php echo $VIEWS?>/usuarios/update.php?id_usuario=<?php echo $usuario['id_usuario'];?>" class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></a>
                                                <a href="<?php echo $VIEWS?>/usuarios/delete.php?id_usuario=<?php echo $usuario['id_usuario']?>" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></a>
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
include('layout/parte2.php');

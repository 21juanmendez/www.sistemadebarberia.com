<?php
include('layout/parte1.php');
include('layout/mensaje.php');
include('../../app/controllers/usuarios/controller_read.php');
include('../../app/controllers/roles/controller_roles.php');
?>
<!--codigo html-->
<div class="container-fluid">
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title"><b>EDITAR USUARIO - Nota: Si no desea cambiar su contraseña, dejelas vacias</b></h3>
        </div>
        <div class="card-body">
            <form class="row g-3" action="<?php echo $URL ?>/app/controllers/usuarios/controller_update.php" method="post">

                <input type="text" value="<?php echo $usuario['id_usuario']?>" name="id_usuario" hidden>

                <div class="col-md-6">
                    <label>Nombre Completo</label>
                    <input value="<?php echo $nombre_completo?>" name=nombre type="text" e class="form-control" placeholder="Name" required>
                </div>
                <div class="col-md-6">
                    <label>Correo Electronico</label>
                    <input value="<?php echo $email?>" name=email type="email" class="form-control" placeholder="info@gmail.com" required>
                </div>
                <div class="col-md-6">
                    <label>Contraseña</label>
                    <input name="password" type="password" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Confirmar Contraseña</label>
                    <input name="password2" type="password" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Telefono</label>
                    <input value="<?php echo $telefono?>" name="telefono" type="number" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="validationDefault04" class="form-label">Cargo</label>
                    <select class="form-select" name="id_rol" id="validationDefault04" required>
                        
                        <option selected value="<?php echo $id_rol?>"><?php echo $cargo?></option>
                        <?php
                        foreach ($roles as $rol) { ?>
                            <option value="<?php echo $rol['id_rol']?>"><?php echo $rol['nombre']?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <center>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success">Actualizar</button>
                        <a href="<?php echo $URL ?>/views/usuarios/usuarios.php" class="btn btn-secondary">Cancelar</a>
                    </div>
                </center>
            </form>
        </div>
    </div>
</div>
<?php
include('layout/parte2.php');
?>
<?php
include('../usuarios/layout/parte1.php');
include('mensaje.php');
?>
<!--codigo html-->
<div class="container-fluid">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><b>CREAR NUEVO ROL</b></h3>
        </div>
        <div class="card-body">
            <form class="row g-3" action="<?php echo $URL ?>/app/controllers/roles/controller_create.php" method="post">
                <div class="col-md-6">
                    <label>Nombre de rol</label>
                    <input name=nombre type="text" class="form-control" placeholder="Name" required>
                </div>
                <center>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Registrar</button>
                        <a href="<?php echo $URL ?>/views/roles" class="btn btn-secondary"> Cancelar</a>
                    </div>
                </center>
            </form>
        </div>
    </div>
</div>
<?php
include('../usuarios/layout/parte2.php');
?>
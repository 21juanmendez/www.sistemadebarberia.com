<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/categorias/controller_read.php');
include('mensaje.php')
?>

<div class="container-fluid">
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title"><b>EDITAR CATEGORIA</b></h3>
        </div>
        <div class="card-body">
            <form class="row g-3" action="<?php echo $URL ?>/app/controllers/categorias/controller_update.php" method="post">
                <input type="text" value="<?php echo $categorias['id_categoria'] ?>" name="id_categoria" hidden>
            
                <div class="col-md-6">
                    <label>Nombre de categoria</label>
                    <input value="<?php echo $categorias['nombre'] ?>" name="nombre" type="text" class="form-control" placeholder="Name" required>
                </div>
                <center>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success">Actualizar</button>
                        <a href="<?php echo $URL ?>/views/categorias" class="btn btn-secondary">Cancelar</a>
                    </div>
                </center>
            </form>
        </div>
    </div>
</div>

<?php
include('../usuarios/layout/parte2.php');
?>
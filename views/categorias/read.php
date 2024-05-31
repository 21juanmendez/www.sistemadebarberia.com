<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/categorias/controller_read.php')
?>

<div class="container-fluid">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"><b>VISUALIZAR CATEGORIA</b></h3>
        </div>
        <div class="card-body">
            <form class="row g-3" action="<?php echo $URL ?>/app/controllers/categorias/controller_create.php" method="post">
                <div class="col-md-6">
                    <label>Nombre de categoria</label>
                    <p><?php echo $categorias['nombre']?></p>
                </div>
                <center>
                    <div class="col-md-12">
                        <a href="<?php echo $URL ?>/views/categorias" class="btn btn-secondary">Regresar</a>
                    </div>
                </center>
            </form>
        </div>
    </div>
</div>

<?php
include('../usuarios/layout/parte2.php');
?>
<?php
include('layout/parte1.php');
include('layout/mensaje.php');
include('../../app/controllers/roles/controller_roles.php');
include('../../app/controllers/usuarios/controller_usuarios.php');
include('../../app/controllers/categorias/controller_categorias.php');
include('../../app/controllers/productos/controller_productos.php');
include('../../app/controllers/servicios/controller_servicios.php');
include('../../app/controllers/empleados/controller_empleados.php');
include('../../app/controllers/ventas/controller_ventas.php');

?>
<div class="container-fluid">
    <h1><b>Panel Administrativo</b></h1>
    <br>
    <div class="row">
        <div class="col-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3><?php echo $contador ?></h3>
                    <p><b>Registros de Roles</b></p>
                </div>
                <div class="icon">
                    <i class="fa fa-address-card"></i>
                </div>
                <a href="../roles/" class="small-box-footer">Más info   <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3><?php echo $contadorUsers ?></h3>
                    <p><b>Registros de Usuarios</b></p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="usuarios.php" class="small-box-footer">Más info    <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        
        <div class="col-3">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3><?php echo $contadorEmpleados ?></h3>
                    <p>Registro de Empleados</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-tie"></i>
                </div>
                <a href="../empleados" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        
        <div class="col-3">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3><?php echo $contadorCategorias ?></h3>
                    <p><b>Registros de Categorias</b></p>
                </div>
                <div class="icon">
                    <i class="fa fa-list-alt"></i>
                </div>
                <a href="../categorias/" class="small-box-footer">Más info  <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-3">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?php echo $contadorProductos ?></h3>
                    <p><b>Registros de Productos</b></p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="../productos/" class="small-box-footer">Más info   <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-3">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3><?php echo $contadorServicios ?></h3>
                    <p><b>Registros de Servicios</b></p>
                </div>
                <div class="icon">
                    <i class="fa fa-cut"></i>
                </div>
                <a href="../servicios/" class="small-box-footer">Más info   <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-3">
            <div class="small-box bg-ligth">
                <div class="inner">
                    <h3><?php echo $contadorVentas ?></h3>
                    <p><b>Registros de Ventas</b></p>
                </div>
                <div class="icon">
                    <i class="bi bi-cart4"></i>
                </div>
                <a href="../ventas/" class="small-box-footer bg-secondary">Más info   <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

    </div>
</div>
</section>

<?php
include('layout/parte2.php');
?>
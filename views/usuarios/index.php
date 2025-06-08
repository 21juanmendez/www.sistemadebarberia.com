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
include('../../app/controllers/citas/controller_citas.php');
include('../../app/controllers/promociones/controller_promociones.php');
include('../../app/controllers/gastos/controller_gastos.php');
include('../../app/controllers/proveedores/controller_proveedores.php');
include('../../app/controllers/categorias_gastos/controller_categorias.php');
include('../../app/controllers/compras/controller_compras.php');


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
                <a href="../roles/" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
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
                <a href="usuarios.php" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-3">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3><?php echo $contadorEmpleados ?></h3>
                    <p><b>Registro de Empleados</b></p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-tie"></i>
                </div>
                <a href="../empleados" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-3">
            <div class="small-box bg-orange">
                <div class="inner text-white">
                    <h3><?php echo $cantidadClientes ?></h3>
                    <p><b>Registros de Clientes</b></p>
                </div>
                <div class="icon">
                    <i class="fa fa-users text-light opacity-75"></i>
                </div>
                <a href="../reportes/clientes.php" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-3">
            <div class="small-box bg-dark">
                <div class="inner">
                    <h3><?php echo $contadorProveedores ?></h3>
                    <p><b>Registros de Proveedores</b></p>
                </div>
                <div class="icon">
                    <i class="fa fa-truck text-light opacity-75"></i>
                </div>
                <a href="../proveedores/" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-3">
            <div class="small-box bg-teal">
                <div class="inner">
                    <h3><?php echo $cantidadCompras ?></h3>
                    <p><b>Registros de Compras</b></p>
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-basket text-light opacity-75"></i>
                </div>
                <a href="../compras/" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-3">
            <div class="small-box bg-purple opacity-75">
                <div class="inner">
                    <h3><?php echo $contadorGastos ?></h3>
                    <p><b>Registros de Gastos</b></p>
                </div>
                <div class="icon">
                    <i class="fa fa-money-bill-wave text-white opacity-75"></i>
                </div>
                <a href="../gastos/" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-3">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3><?php echo $contadorCategorias ?></h3>
                    <p><b>Registros de Categorias</b></p>
                </div>
                <div class="icon">
                    <i class="fa fa-list-alt text-white opacity-75"></i>
                </div>
                <a href="../categorias/" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-3">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?php echo $contadorCategoriasGastos ?></h3>
                    <p><b>Categorías de Gastos</b></p>
                </div>
                <div class="icon">
                    <i class="fa fa-tags text-dark opacity-75"></i>
                </div>
                <a href="../categorias_gastos" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-3">
            <div class="small-box bg-lightblue">
                <div class="inner">
                    <h3><?php echo $contadorPromociones ?></h3>
                    <p><b>Registros de Promociones</b></p>
                </div>
                <div class="icon">
                    <i class="fa fa-gift text-white opacity-75"></i>
                </div>
                <a href="../promociones/" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-3">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?php echo $contadorProductos ?></h3>
                    <p><b>Registros de Productos</b></p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag text-white opacity-75"></i>
                </div>
                <a href="../productos/" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-3">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3><?php echo $contadorServicios ?></h3>
                    <p><b>Registros de Servicios</b></p>
                </div>
                <div class="icon">
                    <i class="fa fa-cut text-white opacity-75"></i>
                </div>
                <a href="../servicios/" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-3">
            <div class="small-box bg-pink">
                <div class="inner">
                    <h3><?php echo $contadorCitas ?></h3>
                    <p><b>Gestion de Citas</b></p>
                </div>
                <div class="icon">
                    <i class="fa fa-calendar text-white opacity-75"></i>
                </div>
                <a href="../citas/" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-3">
            <div class="small-box bg-ligth">
                <div class="inner">
                    <h3><?php echo $contadorVentas ?></h3>
                    <p><b>Registros de Ventas</b></p>
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-cart text-dark opacity-75"></i>
                </div>
                <a href="../ventas/" class="small-box-footer bg-secondary">Más info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

    </div>
</div>
</section>

<?php
include('layout/parte2.php');
?>
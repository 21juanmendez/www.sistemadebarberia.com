<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/productos/controller_read.php');

//include('mensaje.php');
?>
<!--codigo html-->
<div class="container-fluid">
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title"><b>ELIMINAR PRODUCTO</b></h3>
        </div>
        <div class="card-body">
            <form action="<?php echo $URL ?>/app/controllers/productos/controller_delete.php" method="post">
                <div class="row">
                    <div class="col-md-8">
                        <input value="<?php echo $producto['id_producto'] ?>" type="text" name="id_producto" hidden>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Codigo</label>
                                    <p><?php echo $codigo ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nombre del producto</label>
                                    <p><?php echo $nombre_producto ?></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fecha de ingreso</label>
                                    <p><?php echo $fecha_de_ingreso ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Descripcion</label>
                                    <p><?php echo $descripcion ?></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>Categoria</label>
                                <p><?php echo $categoria_nombre ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Stock</label>
                                    <p><?php echo $stock ?></p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Stock minimo</label>
                                    <p><?php echo $stock_minimo ?></p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Stock maximo</label>
                                    <p><?php echo $stock_maximo ?></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Precio de compra</label>
                                    <p><?php echo $precio_compra ?></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Precio de venta</label>
                                    <p><?php echo $precio_venta ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Usuario</label>
                                        <p><?php echo $nombre_usuario ?></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Fecha de creacion</label>
                                        <p><?php echo $fyh_creacion ?></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Fecha de actualizacion</label>
                                        <p><?php echo $fyh_actualizacion ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <center>
                                <label for="">Imagen</label>
                            </center>
                            <center>
                                <img src="<?= $URL . "/public/imagenes/productos/" . $imagen ?>" width="50%">
                            </center>
                        </div>
                    </div>
                </div>
                <center>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Eliminar
                    </button>
                    <a href="<?php echo $VIEWS ?>/productos" class="btn btn-secondary">Cancelar</a>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: red;">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel"><b>Eliminar Usuario<b></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>¿Esta seguro de que desea eliminar a este producto?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger">Aceptar</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </center>
            </form>
        </div>
    </div>
</div>
<?php
include('../usuarios/layout/parte2.php');
?>
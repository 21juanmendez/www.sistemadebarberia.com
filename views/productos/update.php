<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/productos/controller_read.php');
include('../../app/controllers/categorias/controller_categorias.php');

//include('mensaje.php');
?>
<!--codigo html-->
<div class="container-fluid">
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title"><b>EDITAR PRODUCTO</b></h3>
        </div>
        <div class="card-body">
            <form action="<?php echo $URL ?>/app/controllers/productos/controller_update.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <input value="<?php echo $id_producto ?>" name="id_producto" type="text" hidden>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Codigo</label>
                                    <input value="<?php echo $codigo ?>" type="text" class="form-control" disabled>
                                    <input value="<?php echo $codigo ?>" type="text" name="codigo" class="form-control" hidden>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nombre del producto</label>
                                    <input value="<?php echo $nombre_producto ?>" type="text" name="nombre_producto" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fecha de ingreso</label>
                                    <input value="<?php echo $fecha_de_ingreso ?>" type="date" name="fecha_de_ingreso" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Descripcion</label>
                                    <textarea name="descripcion" class="form-control" rows="1"><?php echo $descripcion ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Categoria</label>
                                    <select name="id_categoria" id="" class="form-select">
                                        <option value="<?php echo $id_categoria ?>"><?php echo $categoria_nombre ?></option>
                                        <?php
                                        foreach ($lista_categorias as $categoria) { ?>
                                            <option value="<?php echo $categoria['id_categoria'] ?>"><?php echo $categoria['nombre'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Stock</label>
                                    <input value="<?php echo $stock ?>" type="number" name="stock" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Stock minimo</label>
                                    <input value="<?php echo $stock_minimo ?>" type="number" name="stock_minimo" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Stock maximo</label>
                                    <input value="<?php echo $stock_maximo ?>" type="number" name="stock_maximo" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Precio de compra</label>
                                    <input value="<?php echo $precio_compra ?>" type="number" name="precio_compra" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Precio de venta</label>
                                    <input value="<?php echo $precio_venta ?>" type="number" name="precio_venta" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Seleccione la imagen del producto</label>
                            <input name="file" class="form-control" type="file" id="file" multiple>
                            <input name="imagen" type="text" value="<?php echo $imagen ?>" hidden>
                            <center>
                                <output id="list">
                                    <br>
                                    <img src="<?php echo $URL . "/public/imagenes/productos/" . $imagen ?>" width="50%">
                                </output>
                            </center>
                        </div>
                    </div>
                </div>
                <center>
                    <button class="btn btn-success" type="submit">Actualizar</button>
                    <a href="<?php echo $VIEWS ?>/productos" class="btn btn-secondary">Cancelar</a>

                </center>
            </form>
        </div>
    </div>
</div>
<?php
include('../usuarios/layout/parte2.php');
?>
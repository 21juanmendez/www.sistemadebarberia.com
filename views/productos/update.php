<?php
include('../usuarios/layout/parte1.php');

//include('mensaje.php');
?>
<!--codigo html-->
<div class="container-fluid">
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title"><b>EDITAR PRODUCTO</b></h3>
        </div>
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <input value="" name="id_producto" type="text" hidden>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Codigo</label>
                                    <input value="" type="text" class="form-control" disabled>
                                    <input value="" type="text" name="codigo" class="form-control" hidden>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nombre del producto</label>
                                    <input value="" type="text" name="nombre_producto" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fecha de ingreso</label>
                                    <input value="" type="date" name="fecha_de_ingreso" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Descripcion</label>
                                    <textarea name="descripcion" class="form-control" rows="1"></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Categoria</label>
                                    <select name="id_categoria" id="" class="form-control">
                                        <option value="">Seleccione una categoria</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Stock</label>
                                    <input value="" type="number" name="stock" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Stock minimo</label>
                                    <input value="" type="number" name="stock_minimo" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Stock maximo</label>
                                    <input value="" type=number name="stock_maximo" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Precio de compra</label>
                                    <input value="" type="number" name="precio_compra" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Precio de venta</label>
                                    <input value="" type="number" name="precio_venta" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Seleccione la imagen del producto</label>
                            <input name="file" class="form-control" type="file" id="file" multiple>
                            <input name="imagen" type="text" value="" hidden>
                            <center>
                                <output id="list">
                                    <br>
                                    <img src="" width="50%">
                                </output>
                            </center>
                        </div>
                    </div>
                </div>
                <center>
                    <button class="btn btn-success" type="submit">Actualizar</button>
                    <a href="" class="btn btn-secondary">Cancelar</a>

                </center>
            </form>
        </div>
    </div>
</div>
<?php
include('../usuarios/layout/parte2.php');
?>
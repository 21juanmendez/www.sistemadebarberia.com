<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/productos/controller_productos.php');
include('mensaje.php');
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><b>LISTADO DE PRODUCTOS</b></h3>
                </div>
                <div class="card-body">
                    <a href="<?php echo $VIEWS; ?>/productos/create.php" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Registrar nuevo producto</a>
                    <br><br>
                    <div class="row">
                        <div class="col-md-12">
                            <table id="example3" class="table table-striped table-borderless table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="text-align: center;">#</th>
                                        <th style="text-align: center;">Codigo</th>
                                        <th style="text-align: center;">Nombre del producto</th>
                                        <th style="text-align: center;">Categoria</th>
                                        <th style="text-align: center;">Descripcion</th>
                                        <th style="text-align: center;">Imagen</th>
                                        <th style="text-align: center;">Stock</th>
                                        <th style="text-align: center;">Precio compra</th>
                                        <th style="text-align: center;">Precio venta</th>
                                        <th style="text-align: center;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($productos as $producto) {
                                        $contador++;
                                        $es_stock_bajo = $producto['stock'] <= $producto['stock_minimo'];
                                        $fila_clase = $es_stock_bajo ? 'table-danger' : '';
                                    ?>
                                        <tr class="<?php echo $fila_clase ?>">
                                            <td>
                                                <center><?php echo $contador ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $producto['codigo'] ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $producto['nombre_producto'] ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $producto['nombre'] ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $producto['descripcion'] ?></center>
                                            </td>
                                            <td>
                                                <center>
                                                    <button type="button" class="btn btn-primary" onclick="showCustomImageModal('<?php echo $URL . "/public/imagenes/productos/" . $producto['imagen'] ?>', '<?php echo $producto['nombre_producto'] ?>', '<?php echo $producto['descripcion'] ?>')">
                                                        <i class="bi bi-image-fill"></i>
                                                    </button>

                                                    <script>
                                                        function showCustomImageModal(imageUrl, productName, productDescription) {
                                                            Swal.fire({
                                                                title: productName,
                                                                text: productDescription,
                                                                imageUrl: imageUrl,
                                                                imageWidth: 400,
                                                                imageHeight: 200,
                                                                imageAlt: "Custom image"
                                                            });
                                                        }
                                                    </script>
                                                </center>
                                            </td>
                                            <td>
                                                <center>
                                                    <?php if ($es_stock_bajo): ?>
                                                        <span class="badge bg-danger text-white"><?php echo $producto['stock'] ?> ⚠</span>
                                                    <?php else: ?>
                                                        <?php echo $producto['stock'] ?>
                                                    <?php endif; ?>
                                                </center>
                                            </td>
                                            <td>
                                                <center><?php echo $producto['precio_compra'] ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $producto['precio_venta'] ?></center>
                                            </td>
                                            <td>
                                                <a href="<?php echo $VIEWS ?>/productos/read.php?id_producto=<?php echo $producto['id_producto'] ?>" class="btn btn-info btn-sm"><i class="bi bi-eye-fill"></i></a>
                                                <a href="<?php echo $VIEWS ?>/productos/update.php?id_producto=<?php echo $producto['id_producto'] ?>" class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></a>
                                                <a href="<?php echo $VIEWS ?>/productos/delete.php?id_producto=<?php echo $producto['id_producto'] ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></a>
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
include('../usuarios/layout/parte2.php');

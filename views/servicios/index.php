<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/servicios/controller_servicios.php');
include('mensaje.php');
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><b>LISTADO DE SERVICIOS</b></h3>
                </div>
                <div class="card-body">
                    <a href="<?php echo $VIEWS; ?>/servicios/create.php" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Registrar nuevo servicio</a>
                    <br><br>
                    <div class="row">
                        <div class="col-md-12">
                            <table id="example5" class="table table-striped table-borderless table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="text-align: center;">#</th>
                                        <th style="text-align: center;">Nombre</th>
                                        <th style="text-align: center;">Descripción</th>
                                        <th style="text-align: center;">Precio</th>
                                        <th style="text-align: center;">Puntos para gratis</th>
                                        <th style="text-align: center;">Imagen</th>
                                        <th style="text-align: center;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($servicios as $servicio) {
                                        $contador++;
                                    ?>
                                        <tr>
                                            <td>
                                                <center><?php echo $contador ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $servicio['nombre_servicio'] ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $servicio['descripcion'] ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $servicio['precio'] ?></center>
                                            </td>
                                            <td>
                                                <center>
                                                    <?php echo $servicio['puntos_para_gratis'] ?>
                                                </center>
                                            </td>
                                            <td>
                                                <center>
                                                    <button type="button" class="btn btn-primary" onclick="showCustomImageModal('<?php echo $URL . "/public/imagenes/servicios/" . $servicio['imagen'] ?>', '<?php echo $servicio['nombre_servicio'] ?>', '<?php echo $servicio['descripcion'] ?>')">
                                                        <i class="bi bi-image-fill"></i>
                                                    </button>

                                                    <script>
                                                        function showCustomImageModal(imageUrl, serviceName, serviceDescription) {
                                                            Swal.fire({
                                                                title: serviceName,
                                                                text: serviceDescription,
                                                                imageUrl: imageUrl,
                                                                imageWidth: 400,
                                                                imageHeight: 250,
                                                                imageAlt: "Custom image"
                                                            });
                                                        }
                                                    </script>
                                                </center>
                                            </td>
                                            <td>
                                                <center>
                                                    <a href="<?php echo $VIEWS; ?>/servicios/read.php?id_servicio=<?php echo $servicio['id_servicio'] ?>" class="btn btn-info btn-sm"><i class="bi bi-eye-fill"></i></a>
                                                    <a href="<?php echo $VIEWS; ?>/servicios/update.php?id_servicio=<?php echo $servicio['id_servicio'] ?>" class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></i></a>
                                                    <a href="<?php echo $VIEWS; ?>/servicios/delete.php?id_servicio=<?php echo $servicio['id_servicio'] ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></a>
                                                </center>
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
?>
<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/promociones/controller_promociones.php');
include('mensaje.php');
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><b>LISTADO DE PROMOCIONES</b></h3>
                </div>
                <div class="card-body">
                    <a href="<?php echo $VIEWS; ?>/promociones/create.php" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Registrar nueva promoción</a>
                    <br><br>
                    <div class="row">
                        <div class="col-md-12">
                            <table id="tb_promociones" class="table table-striped table-borderless table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="text-align: center;">#</th>
                                        <th style="text-align: center;">Nombre</th>
                                        <th style="text-align: center;">Descripción</th>
                                        <th style="text-align: center;">Imagen</th>
                                        <th style="text-align: center;">Puntos Requeridos</th>
                                        <th style="text-align: center;">Estado</th>
                                        <th style="text-align: center;">Servicios</th>
                                        <th style="text-align: center;">Fecha Creación</th>
                                        <th style="text-align: center;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($promociones as $promocion) {
                                        $contador++;
                                        // Determinar si la fila debe estar en rojo (promoción no válida)
                                        $rowClass = !$promocion['promo_valida'] ? 'table-danger' : '';
                                    ?>
                                        <tr class="<?php echo $rowClass ?>">
                                            <td>
                                                <center><?php echo $contador ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $promocion['nombre'] ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo substr($promocion['descripcion'], 0, 50) . '...' ?></center>
                                            </td>
                                            <td>
                                                <center>
                                                    <button type="button" class="btn btn-primary" onclick="showCustomImageModal('<?php echo $URL . "/public/imagenes/promociones/" . $promocion['imagen'] ?>', '<?php echo $promocion['nombre'] ?>', '<?php echo $promocion['descripcion'] ?>')">
                                                        <i class="bi bi-image-fill"></i>
                                                    </button>

                                                    <script>
                                                        function showCustomImageModal(imageUrl, promoName, promoDescription) {
                                                            Swal.fire({
                                                                title: promoName,
                                                                text: promoDescription,
                                                                imageUrl: imageUrl,
                                                                imageWidth: 400,
                                                                imageHeight: 200,
                                                                imageAlt: "Imagen de promoción"
                                                            });
                                                        }
                                                    </script>
                                                </center>
                                            </td>
                                            <td>
                                                <center>
                                                    <span class="badge bg-warning text-dark"><?php echo $promocion['puntos_requeridos'] ?> pts</span>
                                                </center>
                                            </td>
                                            <td>
                                                <center>
                                                    <?php if ($promocion['activo']): ?>
                                                        <span class="badge bg-success">Activa</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-secondary">Inactiva</span>
                                                    <?php endif; ?>
                                                </center>
                                            </td>
                                            <td>
                                                <center>
                                                    <?php if ($promocion['promo_valida']): ?>
                                                        <span class="badge bg-success">
                                                            <i class="bi bi-check-circle"></i> Servicios OK
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="badge bg-danger">
                                                            <i class="bi bi-exclamation-triangle"></i> Sin servicios
                                                        </span>
                                                    <?php endif; ?>
                                                    <br><br>
                                                    <a href="<?php echo $VIEWS ?>/promociones/add_servicios.php?id=<?php echo $promocion['id'] ?>" class="btn btn-warning btn-sm">
                                                        <i class="bi bi-plus-circle"></i> Servicios
                                                    </a>
                                                </center>
                                            </td>
                                            <td>
                                                <center><?php echo date('d/m/Y', strtotime($promocion['created_at'])) ?></center>
                                            </td>
                                            <td>
                                                <center>
                                                    <a href="<?php echo $VIEWS ?>/promociones/read.php?id=<?php echo $promocion['id'] ?>" class="btn btn-info btn-sm"><i class="bi bi-eye-fill"></i></a>
                                                    <a href="<?php echo $VIEWS ?>/promociones/update.php?id=<?php echo $promocion['id'] ?>" class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></a>
                                                    <a href="<?php echo $VIEWS ?>/promociones/delete.php?id=<?php echo $promocion['id'] ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></a>
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
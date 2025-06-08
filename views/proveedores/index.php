<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/proveedores/controller_proveedores.php');
include('mensaje.php');
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><b>LISTADO DE PROVEEDORES</b></h3>
                </div>
                <div class="card-body">
                    <a href="<?php echo $VIEWS; ?>/proveedores/create.php" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Registrar nuevo proveedor</a>
                    <br><br>
                    <div class="row">
                        <div class="col-md-12">
                            <table id="tb_proveedores" class="table table-striped table-borderless table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="text-align: center;">#</th>
                                        <th style="text-align: center;">Empresa</th>
                                        <th style="text-align: center;">Contacto</th>
                                        <th style="text-align: center;">Email</th>
                                        <th style="text-align: center;">Teléfono</th>
                                        <th style="text-align: center;">Dirección</th>
                                        <th style="text-align: center;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($proveedores as $proveedor) {
                                        $contador++;
                                    ?>
                                        <tr>
                                            <td>
                                                <center><?php echo $contador ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $proveedor['nombre_empresa'] ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $proveedor['nombre_contacto'] ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $proveedor['email'] ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $proveedor['telefono'] ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $proveedor['direccion'] ?></center>
                                            </td>
                                            <td>
                                                <center>
                                                    <a href="<?php echo $VIEWS; ?>/proveedores/read.php?id_proveedor=<?php echo $proveedor['id_proveedor'] ?>" class="btn btn-info btn-sm"><i class="bi bi-eye-fill"></i></a>
                                                    <a href="<?php echo $VIEWS; ?>/proveedores/update.php?id_proveedor=<?php echo $proveedor['id_proveedor'] ?>" class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $proveedor['id_proveedor'] ?>, '<?php echo addslashes($proveedor['nombre_empresa']) ?>')">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
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
<!-- Modal de Confirmación de Eliminación -->
<div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-centered">
            <div class="modal-header" style="background-color: #dc3545; color: white;">
                <h1 class="modal-title fs-5" id="deleteModalLabel"><b>Eliminar Proveedor</b></h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <i class="bi bi-exclamation-triangle-fill text-warning" style="font-size: 3rem;"></i>
                    <h5 class="mt-2">¿Está seguro de que desea eliminar este proveedor?</h5>
                    <p><strong id="proveedorNombre" class="text-danger"></strong></p>
                    <p class="text-muted">Esta acción no se puede deshacer.</p>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                    <i class="bi bi-trash-fill"></i> Sí, Eliminar
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Cancelar
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    let proveedorIdToDelete = null;

    function confirmDelete(id, nombre) {
        proveedorIdToDelete = id;

        // Mostrar el nombre del proveedor en el modal
        document.getElementById('proveedorNombre').textContent = `"${nombre}"`;

        // Mostrar el modal
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    }

    // Cuando se confirma la eliminación
    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (proveedorIdToDelete) {
            window.location.href = '<?php echo $URL ?>/app/controllers/proveedores/controller_delete.php?id_proveedor=' + proveedorIdToDelete;
        }
    });
</script>

<?php
include('../usuarios/layout/parte2.php');
?>
<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/citas/controller_citas.php');

// Separar citas en próximas y pasadas
$citasProximas = [];
$citasPasadas = [];
foreach ($citas as $cita) {
    if ($cita['fecha_cita'] >= date('Y-m-d')) {
        $citasProximas[] = $cita;
    } else {
        $citasPasadas[] = $cita;
    }
}
?>
<!-- Modal para Detalles del Usuario -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div style="background-color:#0dcaf0;" class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><b>Detalles del Usuario</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="rol" class="form-label">Rol</label>
                            <p id="rol"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nombre_completo" class="form-label">Nombre completo</label>
                            <p id="nombre_completo"></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <p id="email"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <p id="telefono"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><b>LISTADO DE CITAS</b></h3>
                </div>
                <div class="card-body">
                    <a href="<?php echo $URL; ?>/registrar_cita.php" class="btn btn-primary"><i class="bi bi-calendar-date-fill"></i> Ir al Calendario</a>
                    <br><br>

                    <!-- Tabla de Citas Próximas -->
                    <h4><b>Citas Próximas</b></h4>
                    <div class="row">
                        <div class="col-md-12">
                            <table id="example9" class="table table-striped table-hover table-borderless">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col" class="text-center">Usuario</th>
                                        <th scope="col" class="text-center">Servicio</th>
                                        <th scope="col" class="text-center">Fecha</th>
                                        <th scope="col" class="text-center">Hora</th>
                                        <th scope="col" class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($citasProximas as $cita) {
                                        $contador++;
                                    ?>
                                        <tr>
                                            <td class="text-center"><?php echo $contador; ?></td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                    data-rol="<?php echo $cita['nombre']; ?>"
                                                    data-nombre="<?php echo $cita['nombre_completo']; ?>"
                                                    data-telefono="<?php echo $cita['telefono']; ?>"
                                                    data-email="<?php echo $cita['email']; ?>">
                                                    <?php echo $cita['nombre_completo']; ?>
                                                </button>
                                            </td>
                                            <td class="text-center"><?php echo $cita['nombre_servicio']; ?></td>
                                            <td class="text-center"><?php echo $cita['fecha_cita']; ?></td>
                                            <td class="text-center"><?php echo $cita['hora_cita']; ?></td>
                                            <td class="text-center">
                                                <a href="<?php echo $VIEWS ?>/citas/read.php?id_cita=<?php echo $cita['id_cita']; ?>" class="btn btn-info btn-sm"><i class="bi bi-eye-fill"></i></a>
                                                <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $cita['id_cita']; ?>)"><i class="bi bi-trash-fill"></i></button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Tabla de Citas Pasadas -->
                    <br>
                    <h4><b>Citas Pasadas</b></h4>
                    <div class="row">
                        <div class="col-md-12">
                            <table id="example10" class="table table-striped table-hover table-borderless">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col" class="text-center">Usuario</th>
                                        <th scope="col" class="text-center">Servicio</th>
                                        <th scope="col" class="text-center">Fecha</th>
                                        <th scope="col" class="text-center">Hora</th>
                                        <th scope="col" class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($citasPasadas as $cita) {
                                        $contador++;
                                    ?>
                                        <tr>
                                            <td class="text-center"><?php echo $contador; ?></td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                    data-rol="<?php echo $cita['nombre']; ?>"
                                                    data-nombre="<?php echo $cita['nombre_completo']; ?>"
                                                    data-telefono="<?php echo $cita['telefono']; ?>"
                                                    data-email="<?php echo $cita['email']; ?>">
                                                    <?php echo $cita['nombre_completo']; ?>
                                                </button>
                                            </td>
                                            <td class="text-center"><?php echo $cita['nombre_servicio']; ?></td>
                                            <td class="text-center"><?php echo $cita['fecha_cita']; ?></td>
                                            <td class="text-center"><?php echo $cita['hora_cita']; ?></td>
                                            <td class="text-center">
                                                <a href="<?php echo $VIEWS ?>/citas/read.php?id_cita=<?php echo $cita['id_cita']; ?>" class="btn btn-info btn-sm"><i class="bi bi-eye-fill"></i></a>
                                                <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $cita['id_cita']; ?>)"><i class="bi bi-trash-fill"></i></button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Función para confirmar eliminación con SweetAlert2
    function confirmDelete(id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success me-2", // Agrega margen derecho al botón de confirmación
                cancelButton: "btn btn-danger "
            },
            buttonsStyling: false
        });

        swalWithBootstrapButtons.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminarla!',
            cancelButtonText: 'No, cancelar',
            reverseButtons: false
        }).then((result) => {
            if (result.isConfirmed) {
                // Petición de eliminación por AJAX
                fetch('<?php echo $URL ?>/app/controllers/citas/eliminar_cita.php?id_cita=' + id, {
                        method: 'GET'
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            swalWithBootstrapButtons.fire(
                                'Eliminada!',
                                'La cita ha sido eliminada correctamente.',
                                'success'
                            ).then(() => window.location.reload());
                        } else {
                            swalWithBootstrapButtons.fire(
                                'Error',
                                'Hubo un problema al eliminar la cita. Inténtalo de nuevo.',
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        swalWithBootstrapButtons.fire(
                            'Error',
                            'Hubo un error en la conexión. Inténtalo más tarde.',
                            'error'
                        );
                    });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                    'Cancelado',
                    'La cita está a salvo :)',
                    'error'
                );
            }
        });

    }

    // Escuchamos el evento cuando el modal se está por abrir
    var exampleModal = document.getElementById('exampleModal');
    exampleModal.addEventListener('show.bs.modal', function(event) {
        // Obtenemos el botón que activó el modal
        var button = event.relatedTarget;

        // Extraemos la información de los atributos data-
        var nombre = button.getAttribute('data-nombre');
        var telefono = button.getAttribute('data-telefono');
        var email = button.getAttribute('data-email');
        var rol = button.getAttribute('data-rol');

        // Seleccionamos los elementos dentro del modal y les asignamos los valores
        document.getElementById('nombre_completo').textContent = nombre;
        document.getElementById('telefono').textContent = telefono;
        document.getElementById('email').textContent = email;
        document.getElementById('rol').textContent = rol;
    });
</script>

<?php
include('../usuarios/layout/parte2.php');
?>
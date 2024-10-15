<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/citas/controller_citas.php');
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><b>LISTADO DE CITAS</b></h3>
                </div>
                <div class="card-body">
                    <a href="<?php echo $VIEWS; ?>/citas/create.php" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Registrar nueva cita</a>
                    <br><br>
                    <div class="row">
                        <div class="col-md-12">
                            <table id="example2" class="table table-striped table-hover table-borderless">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">
                                            <center>#</center>
                                        </th>
                                        <th scope="col">
                                            <center>Usuario</center>
                                        </th>
                                        <th scope="col">
                                            <center>Servicio</center>
                                        </th>
                                        <th scope="col">
                                            <center>Fecha</center>
                                        </th>
                                        <th scope="col">
                                            <center>Hora</center>
                                        </th>
                                        <th scope="col">
                                            <center>Acciones</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($citas as $cita) {
                                        $contador += 1;
                                    ?>
                                        <tr>
                                            <td>
                                                <center><?php echo $contador; ?></center>
                                            </td>
                                            <td>
                                                <center>
                                                    <button type="button"
                                                        class="btn btn-info"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal"
                                                        data-rol="<?php echo $cita['nombre'] ?>"
                                                        data-nombre="<?php echo $cita['nombre_completo'] ?>"
                                                        data-telefono="<?php echo $cita['telefono'] ?>"
                                                        data-email="<?php echo $cita['email'] ?>">
                                                        <i class="bi bi-person-square"></i>
                                                    </button>
                                                </center>
                                            </td>
                                            <td>
                                                <center><?php echo $cita['nombre_servicio']; ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $cita['fecha_cita']; ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $cita['hora_cita']; ?></center>
                                            </td>
                                            <td>
                                                <center>
                                                    <a href="<?php echo $VIEWS ?>/citas/update.php?id_cita=<?php echo $cita['id_cita']; ?>" class="btn btn-info btn-sm"><i class="bi bi-eye-fill"></i></a>
                                                    <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $cita['id_cita']; ?>)"><i class="bi bi-trash-fill"></i></button>

                                                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                                    <script>
                                                        function confirmDelete(id) {
                                                            Swal.fire({
                                                                title: '¿Estás seguro?',
                                                                text: "¡No podrás revertir esto!",
                                                                icon: 'warning',
                                                                showCancelButton: true,
                                                                confirmButtonColor: '#198754',
                                                                cancelButtonColor: '#dc3545',
                                                                confirmButtonText: 'Sí, eliminarla!',
                                                                cancelButtonText: 'Cancelar'
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    // Enviamos la petición de eliminación por AJAX
                                                                    fetch('<?php echo $URL ?>/app/controllers/citas/eliminar_cita.php?id_cita=' + id, {
                                                                            method: 'GET'
                                                                        })
                                                                        .then(response => response.json())
                                                                        .then(data => {
                                                                            if (data.success) {
                                                                                const swalWithBootstrapButtons = Swal.mixin({
                                                                                    customClass: {
                                                                                        confirmButton: "btn btn-success",
                                                                                        cancelButton: "btn btn-danger"
                                                                                    },
                                                                                    buttonsStyling: false
                                                                                });
                                                                                swalWithBootstrapButtons.fire({
                                                                                    title: 'Eliminada!',
                                                                                    text: 'La cita ha sido eliminada correctamente.',
                                                                                    icon: 'success',
                                                                                    showConfirmButton: true 
                                                                                }).then(() => {
                                                                                    // Refresca la página después de un pequeño retraso
                                                                                    window.location.reload();
                                                                                });
                                                                            } else {
                                                                                Swal.fire(
                                                                                    'Error',
                                                                                    'Hubo un problema al eliminar la cita. Inténtalo de nuevo.',
                                                                                    'error'
                                                                                );
                                                                            }
                                                                        })
                                                                        .catch(error => {
                                                                            Swal.fire(
                                                                                'Error',
                                                                                'Hubo un error en la conexión. Inténtalo más tarde.',
                                                                                'error'
                                                                            );
                                                                        });
                                                                } else if (result.dismiss === Swal.DismissReason.cancel) {
                                                                    const swalWithBootstrapButtons = Swal.mixin({
                                                                        customClass: {
                                                                            confirmButton: "btn btn-success",
                                                                            cancelButton: "btn btn-danger"
                                                                        },
                                                                        buttonsStyling: false
                                                                    });
                                                                    // Si el usuario cancela la eliminación
                                                                    swalWithBootstrapButtons.fire({
                                                                        title: "Cancelado",
                                                                        text: "Tu cita está a salvo :)",
                                                                        icon: "error"
                                                                    });
                                                                }
                                                            });
                                                        }
                                                    </script>
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

<!-- Modal completo -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div style="background-color:#0dcaf0;" class="modal-header">
                <h5 style="color: white;" class="modal-title" id="exampleModalLabel"><b>Detalles del Usuario</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="rol" class="form-label">Rol</label>
                            <input type="text" class="form-control" id="rol" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nombre_completo" class="form-label">Nombre completo</label>
                            <input type="text" class="form-control" id="nombre_completo" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="text" class="form-control" id="email" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
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
        var modalNombre = document.getElementById('nombre_completo');
        var modalTelefono = document.getElementById('telefono');
        var modalEmail = document.getElementById('email');
        var modalRol = document.getElementById('rol');

        // Asignamos los valores correspondientes a cada campo
        modalNombre.value = nombre;
        modalTelefono.value = telefono;
        modalEmail.value = email;
        modalRol.value = rol;
    });
</script>

<?php
include('../usuarios/layout/parte2.php');
?>
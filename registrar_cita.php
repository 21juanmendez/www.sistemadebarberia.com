<?php
include('layout/parte1.php');
include('app/controllers/servicios/controller_servicios.php');
include('app/controllers/usuarios/controller_usuarios.php');

//Con esto guardamos en la variable $usuario el nombre del usuario que se encuentra en la sesion
if (isset($_SESSION['cliente'])) {
    $usuario = $_SESSION['cliente'];
} elseif (isset($_SESSION['admin'])) {
    $usuario = $_SESSION['admin'];
} else {
    $usuario = '';
}
?>

<style>
    #calendar-container {
        background-color: skyblue;
        border-radius: 20px;
        box-shadow: 0px 0px 50px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    #calendar {
        max-width: 100%;
        margin: 0 auto;
    }
</style>

<!--CALENDARIO-->
<section style="background-color: #f5f5f5;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <br>
                <h1 class="text-center">Reserva una Cita</h1>
                <br>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div id='calendar-container'>
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
</section>
<!--FIN CALENDARIO-->

<!-- Vertically centered modal HORARIOS-->
<div class="modal fade" id="modal-reservas" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div style="background-color:#0d6efd ;" class="modal-header">
                <h1 style="color: white;" class="modal-title fs-5" id="staticBackdropLabel"><b>Reserva tu cita para el dia <span id="dia_de_la_semana"></span></b></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-md 6">
                        <center>
                            Turnos de la mañana
                        </center>
                        <br>
                        <div class="d-grid gap-1">
                            <button type="button" id="btn_h1" class="btn btn-success">08:00 - 09:00</button>
                            <button type="button" id="btn_h2" class="btn btn-success">09:00 - 10:00</button>
                            <button type="button" id="btn_h3" class="btn btn-success">10:00 - 11:00</button>
                            <button type="button" id="btn_h4" class="btn btn-success">11:00 - 12:00</button>
                            <br>
                        </div>
                    </div>

                    <div class="col-md 6">
                        <center>
                            Turnos de la tarde
                        </center>
                        <br>
                        <div class="d-grid gap-1">
                            <button type="button" id="btn_h5" class="btn btn-success">13:00 - 14:00</button>
                            <button type="button" id="btn_h6" class="btn btn-success">14:00 - 15:00</button>
                            <button type="button" id="btn_h7" class="btn btn-success">15:00 - 16:00</button>
                            <button type="button" id="btn_h8" class="btn btn-success">16:00 - 17:00</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Vertically centered modal FORMULARIO -->
<div class="modal fade" id="modal-formulario" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div style="background-color:#0d6efd ;" class="modal-header">
                <h1 style="color: white;" class="modal-title fs-5" id="staticBackdropLabel"><b>Seleccione un servicio <?php echo $usuario ?><span id="dia_de_la_semana"></span></b></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form action="app/controllers/citas/controller_create.php" method="post">
                        <div class="row">
                            <div class="col-md 6">
                                <div class="mb-3">
                                    <label><b>Usuario</b></label>
                                    <!--<p><?php echo isset($_SESSION['nombre_usuario']) ? $_SESSION['nombre_usuario'] : ''; ?></p>-->
                                    <input type="text" class="form-control" value="<?php echo $usuario; ?>" readonly>
                                    <input hidden name="id_usuario" value="<?php echo $_SESSION['id']; ?>">
                                </div>
                            </div>

                            <div class="col-md 6">
                                <div class="mb-3">
                                    <label for=""><b>Tipo de Servicio</b></label>
                                    <select name="id_servicio" class="form-select" required>
                                        <option value="" selected>Selecciona un servicio</option>
                                        <!-- Recorremos el array $servicios para generar las opciones -->
                                        <?php foreach ($servicios as $servicio) : ?>
                                            <option value="<?php echo $servicio['id_servicio']; ?>"><?php echo $servicio['nombre_servicio']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md 6">
                                <div class="mb-3">
                                    <label><b>Fecha de reserva</b></label>
                                    <input type="text" id="fecha_cita" name="fecha_cita" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md 6">
                                <div class="mb-3">
                                    <label for=""><b>Hora de reserva</b></label>
                                    <input type="text" id="hora_cita" name="hora_cita" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" id="regresar" class="btn btn-secondary">Regresar</button>
                            <button type="submit" class="btn btn-primary">Reservar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!--SCRIPT PARA CALENDARIO-->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
<script>
    var a; // Variable para almacenar la fecha seleccionada
    var usuario = '<?php echo $usuario ?>'; // Usuario logueado
    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date(); // Fecha y hora actual
        var todayDate = today.toISOString().split('T')[0]; // Obtener la fecha actual en formato YYYY-MM-DD
        var currentHour = today.getHours(); // Obtener la hora actual en formato 24 horas

        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            editable: true,
            selectable: true,
            allDaySlot: false,

            // Restricción para que no se pueda seleccionar fechas anteriores al día actual
            validRange: {
                start: todayDate // No permite seleccionar fechas anteriores a la fecha actual
            },

            // Cargamos las citas agendadas para mostrarlas en el calendario
            events: 'app/controllers/citas/cargar_reservas.php',

            // Acción al hacer clic en una fecha
            dateClick: function(info) {
                a = info.dateStr; // Guardamos la fecha seleccionada
                var selectedDate = new Date(a); // Convertir la fecha seleccionada a objeto Date

                // Verificamos si el usuario está logueado
                if (usuario == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Debes iniciar sesión para reservar una cita',
                        footer: '<a href="<?php echo $VIEWS ?>/login">¿Ya tienes una cuenta?</a>'
                    });
                } else {
                    // Hacemos una petición AJAX para obtener las horas ocupadas de la fecha seleccionada
                    $.ajax({
                        url: 'app/controllers/citas/cargar_reservas.php',
                        type: 'GET',
                        data: {
                            fecha: a
                        },
                        success: function(response) {
                            var horasOcupadas = JSON.parse(response); // Parseamos el JSON recibido

                            // Limpiamos el estilo de los botones de las horas (por si se seleccionó una fecha anterior)
                            $('button[id^="btn_h"]').removeClass('btn-danger').addClass('btn-success').prop('disabled', false);

                            // Verificar si la fecha seleccionada es hoy
                            if (selectedDate.toISOString().split('T')[0] === todayDate) {
                                // Si es hoy, deshabilitamos las horas pasadas
                                $('button[id^="btn_h"]').each(function() {
                                    // Obtener la hora del botón
                                    var horaBoton = $(this).text().trim();
                                    var horaNumero = parseInt(horaBoton.split(':')[0]);

                                    // Deshabilitar los botones correspondientes a horas pasadas
                                    if (horaNumero < currentHour) {
                                        $(this).removeClass('btn-success').addClass('btn-secondary').prop('disabled', true);
                                    }
                                });
                            }

                            // Iteramos sobre las horas ocupadas y deshabilitamos los botones correspondientes
                            horasOcupadas.forEach(function(hora) {
                                switch (hora) {
                                    case '08:00 - 09:00':
                                        $('#btn_h1').removeClass('btn-success').addClass('btn-danger').prop('disabled', true);
                                        break;
                                    case '09:00 - 10:00':
                                        $('#btn_h2').removeClass('btn-success').addClass('btn-danger').prop('disabled', true);
                                        break;
                                    case '10:00 - 11:00':
                                        $('#btn_h3').removeClass('btn-success').addClass('btn-danger').prop('disabled', true);
                                        break;
                                    case '11:00 - 12:00':
                                        $('#btn_h4').removeClass('btn-success').addClass('btn-danger').prop('disabled', true);
                                        break;
                                    case '13:00 - 14:00':
                                        $('#btn_h5').removeClass('btn-success').addClass('btn-danger').prop('disabled', true);
                                        break;
                                    case '14:00 - 15:00':
                                        $('#btn_h6').removeClass('btn-success').addClass('btn-danger').prop('disabled', true);
                                        break;
                                    case '15:00 - 16:00':
                                        $('#btn_h7').removeClass('btn-success').addClass('btn-danger').prop('disabled', true);
                                        break;
                                    case '16:00 - 17:00':
                                        $('#btn_h8').removeClass('btn-success').addClass('btn-danger').prop('disabled', true);
                                        break;
                                }
                            });

                            // Mostramos el modal para elegir las horas
                            $('#modal-reservas').modal('show');
                            $('#dia_de_la_semana').html(a);
                        }
                    });
                }
            }
        });

        // Finalmente, renderizamos el calendario
        calendar.render();
    });
</script>
<!--FIN SCRIPT PARA CALENDARIO-->

<script>
    $('#btn_h1').click(function() {
        $('#modal-reservas').modal('hide');
        $('#modal-formulario').modal('show');
        $('#fecha_cita').val(a); //para input
        $('#hora_cita').val('08:00 - 09:00'); //para input
        //$('#fecha_cita').text(a);//para p
        //$('#hora_cita').text('08:00 - 09:00');//para p
    });
    $('#btn_h2').click(function() {
        $('#modal-reservas').modal('hide');
        $('#modal-formulario').modal('show');
        $('#fecha_cita').val(a); //para input
        $('#hora_cita').val('09:00 - 10:00'); //para input
    });
    $('#btn_h3').click(function() {
        $('#modal-reservas').modal('hide');
        $('#modal-formulario').modal('show');
        $('#fecha_cita').val(a); //para input
        $('#hora_cita').val('10:00 - 11:00'); //para input
    });
    $('#btn_h4').click(function() {
        $('#modal-reservas').modal('hide');
        $('#modal-formulario').modal('show');
        $('#fecha_cita').val(a); //para input
        $('#hora_cita').val('11:00 - 12:00'); //para input
    });
    $('#btn_h5').click(function() {
        $('#modal-reservas').modal('hide');
        $('#modal-formulario').modal('show');
        $('#fecha_cita').val(a); //para input
        $('#hora_cita').val('13:00 - 14:00'); //para input
    });
    $('#btn_h6').click(function() {
        $('#modal-reservas').modal('hide');
        $('#modal-formulario').modal('show');
        $('#fecha_cita').val(a); //para input
        $('#hora_cita').val('14:00 - 15:00'); //para input
    });
    $('#btn_h7').click(function() {
        $('#modal-reservas').modal('hide');
        $('#modal-formulario').modal('show');
        $('#fecha_cita').val(a); //para input
        $('#hora_cita').val('15:00 - 16:00'); //para input
    });
    $('#btn_h8').click(function() {
        $('#modal-reservas').modal('hide');
        $('#modal-formulario').modal('show');
        $('#fecha_cita').val(a); //para input
        $('#hora_cita').val('16:00 - 17:00'); //para input
    });
    $('#regresar').click(function() {
        $('#modal-reservas').modal('show');
        $('#modal-formulario').modal('hide');
    });
</script>

<?php
include('layout/parte2.php');
?>
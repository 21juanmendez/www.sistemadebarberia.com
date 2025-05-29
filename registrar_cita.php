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
    /* Estilo general para el contenedor del calendario */
    #calendar-container {
        background-color: #ffffff;
        /* Fondo blanco para un aspecto limpio */
        border-radius: 15px;
        /* Bordes ligeramente redondeados */
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        /* Sombra suave */
        padding: 30px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        margin-bottom: 40px;
    }

    /* Efecto de elevación al pasar el ratón */
    #calendar-container:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }

    /* Estilo del calendario */
    #calendar {
        max-width: 100%;
        margin: 0 auto;
        border-radius: 15px;
        overflow: hidden;
        background-color: #f9fafb;
        /* Fondo gris claro */
    }

    /* Estilos para los encabezados de los días de la semana */
    .fc-day-header {
        background-color: #4a90e2;
        /* Color azul profesional */
        color: #ffffff;
        font-weight: bold;
        padding: 12px;
        text-align: center;
        text-transform: uppercase;
        font-size: 13px;
        border-bottom: 1px solid #e0e0e0;
    }

    /* Estilos para los días del calendario */
    .fc-day {
        background-color: #ffffff;
        border: 1px solid #e0e0e0;
        transition: background-color 0.2s ease;
        cursor: pointer;
    }

    /* Efecto al pasar el ratón por los días */
    .fc-day:hover {
        background-color: #f1f5f8;
        /* Gris muy claro */
    }

    /* Estilos para los eventos */
    .fc-event {
        border-radius: 8px;
        padding: 8px;
        font-weight: 500;
        color: white;
        text-align: center;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    /* Efecto de elevación para los eventos */
    .fc-event:hover {
        box-shadow: 0 5px 12px rgba(0, 0, 0, 0.15);
        transform: translateY(-2px);
    }

    /* Colores degradados para eventos */
    .fc-event-success {
        background: linear-gradient(135deg, #81c784, #4caf50);
        /* Verde sutil */
    }

    .fc-event-warning {
        background: linear-gradient(135deg, #ffd54f, #ffb300);
        /* Amarillo dorado */
    }

    .fc-event-danger {
        background: linear-gradient(135deg, #e57373, #d32f2f);
        /* Rojo sutil */
    }

    /* Estilos para el día de hoy */
    .fc-today {
        background-color: #fff9c4;
        /* Amarillo suave */
        border: 2px solid #ffeb3b;
        font-weight: bold;
    }

    /* Ajustes responsivos */
    @media (max-width: 768px) {
        #calendar-container {
            padding: 20px;
        }

        .fc-day-header {
            padding: 8px;
            font-size: 12px;
        }

        .fc-event {
            padding: 6px;
            font-size: 11px;
        }
    }
</style>

<!--CALENDARIO-->
<section style="background-color: #f5f5f5;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <br>
                <h1 class="fw-bold" style="text-align: center;">Reserva una Cita</h1>
                <p class="text-center">Selecciona una fecha para reservar una cita</p>
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
                        <center>Turnos de la mañana</center>
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
                        <center>Turnos de la tarde</center>
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
                                    <input type="text" class="form-control" value="<?php echo $usuario; ?>" readonly>
                                    <input hidden name="id_usuario" value="<?php echo $_SESSION['id']; ?>">
                                </div>
                            </div>
                            <div class="col-md 6">
                                <div class="mb-3">
                                    <label for=""><b>Tipo de Servicio</b></label>
                                    <select name="id_servicio" class="form-select" required>
                                        <option value="" selected>Selecciona un servicio</option>
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

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
<script>
    var a; // Variable para almacenar la fecha seleccionada
    var usuario = '<?php echo $usuario ?>'; // Usuario logueado

    document.addEventListener('DOMContentLoaded', function() {
        var options = {
            timeZone: 'America/El_Salvador',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            year: 'numeric',
            month: '2-digit',
            day: '2-digit'
        };
        var today = new Date();
        var todayInElSalvador = new Intl.DateTimeFormat('es-SV', options).format(today);
        var dateElSalvador = new Intl.DateTimeFormat('en-CA', {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit',
            timeZone: 'America/El_Salvador'
        }).format(today);
        var currentHourElSalvador = parseInt(new Intl.DateTimeFormat('es-SV', {
            hour: '2-digit',
            timeZone: 'America/El_Salvador',
            hour12: false
        }).format(today));

        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            editable: true,
            selectable: true,
            allDaySlot: false,
            validRange: {
                start: dateElSalvador
            },
            events: 'app/controllers/citas/cargar_reservas.php',
            dateClick: function(info) {
                a = info.dateStr;
                var selectedDate = new Date(a + "T00:00:00-06:00"); // Ajuste a zona horaria de El Salvador (-06:00)
                var selectedDateFormatted = selectedDate.toISOString().split('T')[0];
                var dayOfWeek = selectedDate.getUTCDay();
                var dia = selectedDate.getDate();
                var mes = selectedDate.toLocaleString('es-SV', {
                    month: 'long'
                });
                var anio = selectedDate.getFullYear();
                var diasSemana = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
                var finalDate = `${diasSemana[dayOfWeek]} ${dia} de ${mes} del ${anio}`;

                $('#dia_de_la_semana').text(finalDate);

                if (usuario == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Debes iniciar sesión para reservar una cita',
                        footer: '<a href="<?php echo $VIEWS ?>/login">¿Ya tienes una cuenta?</a>'
                    });
                } else {
                    if (dayOfWeek == 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'No se pueden agendar citas los domingos'
                        });
                        return;
                    }
                    $.ajax({
                        url: 'app/controllers/citas/cargar_reservas.php',
                        type: 'GET',
                        data: {
                            fecha: a
                        },
                        success: function(response) {
                            var horasOcupadas = JSON.parse(response);
                            $('button[id^="btn_h"]').removeClass('btn-danger').addClass('btn-success').prop('disabled', false);

                            if (selectedDateFormatted === dateElSalvador) {
                                $('button[id^="btn_h"]').each(function() {
                                    var horaBoton = $(this).text().trim();
                                    var horaNumero = parseInt(horaBoton.split(':')[0]);
                                    if (horaNumero < currentHourElSalvador) {
                                        $(this).removeClass('btn-success').addClass('btn-secondary').prop('disabled', true);
                                    } else {
                                        $(this).removeClass('btn-secondary').addClass('btn-success').prop('disabled', false);
                                    }
                                });
                            } else {
                                $('button[id^="btn_h"]').removeClass('btn-secondary').addClass('btn-success').prop('disabled', false);
                            }

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

                            $('#modal-reservas').modal('show');
                        }
                    });
                }
            },
            eventClick: function(info) {
                if (usuario == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Debes iniciar sesión para ver los detalles de la cita',
                        footer: '<a href="<?php echo $VIEWS ?>/login">¿Ya tienes una cuenta?</a>'
                    });
                } else {
                    var eventObj = info.event;
                    $.ajax({
                        url: 'app/controllers/citas/cargar_detalle_citas.php',
                        type: 'GET',
                        data: {
                            id: eventObj.id
                        },
                        success: function(response) {
                            if (response.error) {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Oops...',
                                    text: response.error
                                });
                            } else {
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Detalles de la Cita',
                                    html: `<div style="text-align: center; font-size: 1.1em; line-height: 1.6;">
                                            <p><b>Usuario:</b> ${response.usuario}</p>
                                            <p><b>Servicio:</b> ${response.servicio}</p>
                                            <p><b>Fecha:</b> ${response.fecha}</p>
                                            <p><b>Hora:</b> ${response.hora}</p>
                                            <br><button id="deleteCita" class="btn btn-danger" style="padding: 10px 20px; font-size: 1em; border-radius: 5px; border: none; color: #fff; background-color: #dc3545; cursor: pointer;">Cancelar</button></div>`,
                                    showConfirmButton: false,
                                    width: 475,
                                    padding: "2em",
                                    color: "#333",
                                    background: "#fff url(/images/trees.png) center / cover",
                                    backdrop: `rgba(0,0,123,0.4) url("<?php echo $URL ?>/public/imagenes/nyan-cat-nyan.gif") left top no-repeat`
                                });
                                document.getElementById('deleteCita').addEventListener('click', function() {
                                    var currentDateTime = new Date();
                                    var citaDateTime = new Date(response.fecha + ' ' + response.hora.split(' - ')[0]);
                                    var diffInHours = (citaDateTime - currentDateTime) / (1000 * 60 * 60);
                                    if (diffInHours <= 4) {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'No se puede cancelar',
                                            text: 'No puedes cancelar la cita con menos de 4 horas de anticipación.'
                                        });
                                    } else {
                                        Swal.fire({
                                            title: '¿Estás seguro?',
                                            text: "¡Esta acción no se puede deshacer!",
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#198754',
                                            cancelButtonColor: '#dc3545',
                                            confirmButtonText: 'Sí, eliminarla',
                                            cancelButtonText: 'No, cancelar'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                $.ajax({
                                                    url: 'app/controllers/citas/eliminar_cita.php',
                                                    type: 'POST',
                                                    data: {
                                                        id: response.id
                                                    },
                                                    success: function(response) {
                                                        var resultado = JSON.parse(response);
                                                        if (resultado.success) {
                                                            eventObj.remove();
                                                            Swal.fire('Eliminada', 'La cita ha sido eliminada.', 'success');

                                                        } else {
                                                            Swal.fire('Error', resultado.message, 'error');
                                                        }
                                                    },
                                                    error: function(jqXHR, textStatus, errorThrown) {
                                                        Swal.fire('Error', 'Hubo un problema al eliminar la cita.', 'error');
                                                    }
                                                });
                                            }
                                        });
                                    }
                                });
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Error al cargar los detalles de la cita.');
                        }
                    });
                }
            }
        });
        calendar.render();
    });

    function seleccionarHora(horaInicio, horaFin) {
        var currentDateTime = new Date().toLocaleString("en-US", {
            timeZone: "America/El_Salvador"
        });
        currentDateTime = new Date(currentDateTime);
        var selectedDateTime = new Date(a + ' ' + horaInicio);
        var diffInHours = (selectedDateTime - currentDateTime) / (1000 * 60 * 60);
        if (diffInHours < 4) {
            Swal.fire({
                icon: 'error',
                title: 'No se puede reservar',
                text: 'Debes reservar con al menos 4 horas de anticipación.'
            });
        } else {
            $('#modal-reservas').modal('hide');
            $('#modal-formulario').modal('show');
            $('#fecha_cita').val(a);
            $('#hora_cita').val(horaInicio + ' - ' + horaFin);
        }
    }

    $('#btn_h1').click(function() {
        seleccionarHora('08:00', '09:00');
    });
    $('#btn_h2').click(function() {
        seleccionarHora('09:00', '10:00');
    });
    $('#btn_h3').click(function() {
        seleccionarHora('10:00', '11:00');
    });
    $('#btn_h4').click(function() {
        seleccionarHora('11:00', '12:00');
    });
    $('#btn_h5').click(function() {
        seleccionarHora('13:00', '14:00');
    });
    $('#btn_h6').click(function() {
        seleccionarHora('14:00', '15:00');
    });
    $('#btn_h7').click(function() {
        seleccionarHora('15:00', '16:00');
    });
    $('#btn_h8').click(function() {
        seleccionarHora('16:00', '17:00');
    });
    $('#regresar').click(function() {
        $('#modal-reservas').modal('show');
        $('#modal-formulario').modal('hide');
    });
</script>

<?php include('layout/parte2.php'); ?>
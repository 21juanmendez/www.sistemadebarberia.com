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
    background-color: #fdfdfd;
    /* Fondo más claro */
    border-radius: 20px;
    /* Bordes más suaves */
    box-shadow: 0 6px 24px rgba(0, 0, 0, 0.12);
    /* Sombra suave */
    padding: 40px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    margin-bottom: 40px;
}

/* Efecto de elevación al pasar el ratón */
#calendar-container:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.18);
}

/* Estilo del calendario */
#calendar {
    max-width: 100%;
    margin: 0 auto;
    border-radius: 20px;
    overflow: hidden;
    background-color: #f9fafb;
    /* Fondo más claro */
}

/* Estilos para los días de la semana (encabezados) */
.fc-day-header {
    background: linear-gradient(135deg, #ffcc80 0%, #ffa726 100%);
    /* Gradiente dorado */
    color: #2c2c2c;
    /* Texto oscuro */
    font-weight: bold;
    padding: 15px;
    text-align: center;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-size: 14px;
    border-bottom: 2px solid #e0e0e0;
    transition: background-color 0.3s ease;
}

/* Estilos para los días del calendario */
.fc-day {
    background-color: #ffffff;
    border: 1px solid #e0e0e0;
    transition: background-color 0.3s ease, transform 0.3s ease;
    cursor: pointer;
}

/* Efecto de cambio de color y elevación al pasar el ratón */
.fc-day:hover {
    background-color: #fff3e0;
    /* Suave tono crema */
    transform: scale(1.02);
    z-index: 10;
}

/* Estilos para eventos */
.fc-event {
    border-radius: 10px;
    padding: 10px;
    font-weight: bold;
    color: white;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
}

/* Animación sutil para eventos */
.fc-event:hover {
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    transform: translateY(-3px);
}

/* Colores degradados para eventos */
.fc-event-success {
    background: linear-gradient(135deg, #66bb6a 0%, #43a047 100%);
    /* Degradado verde */
}

.fc-event-warning {
    background: linear-gradient(135deg, #ffca28 0%, #f57f17 100%);
    /* Degradado dorado */
}

.fc-event-danger {
    background: linear-gradient(135deg, #ef5350 0%, #d32f2f 100%);
    /* Degradado rojo */
}

/* Estilos para el día de hoy */
.fc-today {
    background-color: #ffecb3;
    /* Fondo dorado suave para el día actual */
    border: 2px solid #ffb74d;
    /* Borde dorado */
    font-weight: bold;
}

/* Animación para los días actuales */
.fc-today-highlight {
    animation: pulse 1.5s infinite;
}

/* Animación de pulso para el día actual */
@keyframes pulse {
    0% {
        box-shadow: 0 0 0 0 rgba(255, 183, 77, 0.4);
    }
    70% {
        box-shadow: 0 0 0 15px rgba(255, 183, 77, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(255, 183, 77, 0);
    }
}

/* Ajustes responsivos */
@media (max-width: 768px) {
    #calendar-container {
        padding: 20px;
    }

    .fc-day-header {
        padding: 10px;
        font-size: 12px;
    }

    .fc-event {
        padding: 8px;
        font-size: 12px;
    }
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

<!-- Importamos la librería FullCalendar -->
<script>
    var a; // Variable para almacenar la fecha seleccionada
    var usuario = '<?php echo $usuario ?>'; // Usuario logueado

    document.addEventListener('DOMContentLoaded', function() {
        // Obtener la fecha y hora en la zona horaria de El Salvador
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

        //today.setDate(today.getDate() + 1); // Esto hace que sea "mañana para pruebas"
        var todayInElSalvador = new Intl.DateTimeFormat('es-SV', options).format(today);

        // Mostrar la fecha y hora en la consola (zona horaria correcta)
        console.log("Fecha y hora ajustada (El Salvador): " + todayInElSalvador);

        // Obtener solo la fecha actual (YYYY-MM-DD) usando la zona horaria correcta de El Salvador
        var dateElSalvador = new Intl.DateTimeFormat('en-CA', {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit',
            timeZone: 'America/El_Salvador'
        }).format(today);
        console.log("Fecha actual (YYYY-MM-DD): " + dateElSalvador);

        // Obtener la hora actual en formato 24 horas de El Salvador
        var currentHourElSalvador = parseInt(new Intl.DateTimeFormat('es-SV', {
            hour: '2-digit',
            timeZone: 'America/El_Salvador',
            hour12: false
        }).format(today));
        console.log("Hora actual (hora en formato 24h): " + currentHourElSalvador);

        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            editable: true,
            selectable: true,
            allDaySlot: false,

            // Restricción para que no se pueda seleccionar fechas anteriores al día actual
            validRange: {
                start: dateElSalvador // Usamos la fecha correcta de El Salvador
            },
            // Cargamos las citas agendadas para mostrarlas en el calendario
            events: 'app/controllers/citas/cargar_reservas.php',

            // Acción al hacer clic en una fecha
            dateClick: function(info) {
                a = info.dateStr; // Guardamos la fecha seleccionada
                var selectedDate = new Date(a);
                var selectedDateFormatted = selectedDate.toISOString().split('T')[0]; // Formato YYYY-MM-DD
                var dayOfWeek = selectedDate.getUTCDay(); // Día de la semana (0-6)

                // Obtener el día, mes y año para mostrarlo en el modal
                var dia = selectedDate.getDate() + 1; // Obtener el día del mes
                var mes = selectedDate.toLocaleString('es-SV', {
                    month: 'long'
                }); // Obtener el nombre del mes en español
                var anio = selectedDate.getFullYear(); // Obtener el año

                // Concatenar el día de la semana y la fecha formateada
                var diasSemana = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
                var finalDate = `${diasSemana[dayOfWeek]} ${dia} de ${mes} del ${anio}`; // Ejemplo: "Lunes 23 de octubre del 2024"

                // Mostrar el día y la fecha seleccionada en el modal
                $('#dia_de_la_semana').text(finalDate); // Mostrar en el formato deseado

                // Verificamos si el usuario está logueado
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

                            // Si la fecha seleccionada es hoy (El Salvador)
                            if (selectedDateFormatted === dateElSalvador) {
                                // Deshabilitamos solo las horas pasadas del día actual
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
                                // Si es un día futuro, todas las horas deben estar habilitadas
                                $('button[id^="btn_h"]').removeClass('btn-secondary').addClass('btn-success').prop('disabled', false);
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

                        }
                    });
                }
            },

            //Cuando le damos click a un evento en este caso a una cita
            eventClick: function(info) {

                if (usuario == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Debes iniciar sesión para ver los detalles de la cita',
                        footer: '<a href="<?php echo $VIEWS ?>/login">¿Ya tienes una cuenta?</a>'
                    });
                } else {
                    var eventObj = info.event; // Obtenemos el objeto del evento

                    // Hacer una solicitud AJAX para obtener los detalles de la cita
                    $.ajax({
                        url: 'app/controllers/citas/cargar_detalle_citas.php', // Controlador para cargar detalles de la cita
                        type: 'GET',
                        data: {
                            id: eventObj.id // Pasamos el ID del evento
                        },
                        success: function(response) {
                            console.log('Respuesta del servidor:', response); // Para ver qué se está recibiendo

                            // Determinamos si la respuesta es un error o si tiene los detalles
                            if (response.error) {

                                // Mostrar un mensaje de error en caso de que no se encuentre la cita
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Oops...',
                                    text: response.error
                                });

                            } else {
                                // Mostrar los detalles de la cita en SweetAlert (Swal)
                                Swal.fire({
                                    title: 'Detalles de la Cita',
                                    html: `
                                        <div style="text-align: left;">
                                            <b>Servicio:</b> ${response.servicio}<br>
                                            <b>Fecha:</b> ${response.fecha}<br>
                                            <b>Hora:</b> ${response.hora}<br>
                                            <b>Usuario:</b> ${response.usuario}<br><br>
                                        </div>
                                        <button id="closeModal" class="btn btn-secondary">Cerrar Ventana</button>
                                        <button id="deleteCita" class="btn btn-danger">Cancelar Cita</button>
                                        
                                    `,
                                    showConfirmButton: false,
                                    width: 600, // Ancho de la alerta
                                    padding: "3em", // Relleno
                                    color: "#716add", // Color del texto
                                    background: "#fff url(/images/trees.png)", // Fondo personalizado
                                    backdrop: `
                                        rgba(0,0,123,0.4)
                                        url("<?php echo $URL ?>/public/imagenes/nyan-cat-nyan.gif")
                                        left top
                                        no-repeat
                                        `
                                });

                                // Escuchar el evento del botón para cerrar la alerta
                                document.getElementById('closeModal').addEventListener('click', function() {
                                    Swal.close(); // Cerrar la alerta
                                });
                                // Escuchar el evento del botón para cancelar la cita
                                document.getElementById('deleteCita').addEventListener('click', function() {
                                    var currentDateTime = new Date();
                                    var citaDateTime = new Date(response.fecha + ' ' + response.hora.split(' - ')[0]);

                                    // Calcular la diferencia en horas entre la fecha y hora actual y la fecha y hora de la cita
                                    var diffInHours = (citaDateTime - currentDateTime) / (1000 * 60 * 60);

                                    if (diffInHours <= 4) {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'No se puede cancelar',
                                            text: 'No puedes cancelar la cita con menos de 4 horas de anticipación.'
                                        });
                                    } else {
                                        // Confirmación para eliminar la cita
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
                                                // Si el usuario confirma, realizar la solicitud AJAX para eliminar la cita
                                                $.ajax({
                                                    url: 'app/controllers/citas/eliminar_cita.php', // Cambia esta URL a la correcta
                                                    type: 'POST',
                                                    data: {
                                                        id: response.id // Enviar el ID de la cita a eliminar
                                                    },
                                                    success: function(response) {
                                                        var resultado = JSON.parse(response);

                                                        if (resultado.success) {
                                                            // Eliminar el evento del calendario si se eliminó correctamente
                                                            eventObj.remove();
                                                            const swalWithBootstrapButtons = Swal.mixin({
                                                                customClass: {
                                                                    confirmButton: "btn btn-success",
                                                                    cancelButton: "btn btn-danger"
                                                                },
                                                                buttonsStyling: false
                                                            });
                                                            swalWithBootstrapButtons.fire('Eliminada', 'La cita ha sido eliminada.', 'success');
                                                        } else {
                                                            Swal.fire('Error', resultado.message, 'error');
                                                        }
                                                    },
                                                    error: function(jqXHR, textStatus, errorThrown) {
                                                        console.error("Error en la solicitud AJAX:", textStatus, errorThrown);
                                                        Swal.fire('Error', 'Hubo un problema al eliminar la cita.', 'error');
                                                    }
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
                                });
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error("Error en la solicitud AJAX:", textStatus, errorThrown);
                            alert('Error al cargar los detalles de la cita.'); // Mensaje de error para el usuario
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
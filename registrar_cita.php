<?php
include('layout/parte1.php');
?>

<!--CALENDARIO-->
<section style="background-color: #f5f5f5;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <br>
                <h1 class="text-center" >Reserva una Cita</h1>
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

<!--SCRIPT PARA CALENDARIO-->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            events: [{ // this object will be "parsed" into an Event Object
                title: 'The Title', // a property!
                start: '2024-02-27', // a property!
                end: '2024-02-27' // a property! ** see important note below about 'end' **
            }]
        });
        calendar.render();
    });
</script>
<!--FIN SCRIPT PARA CALENDARIO-->

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

<?php
include('layout/parte2.php');
?>
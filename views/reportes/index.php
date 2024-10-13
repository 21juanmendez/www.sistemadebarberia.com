<?php
include '../usuarios/layout/parte1.php';
include('../../app/controllers/reportes/reportes_filter.php');

?>

<div class="content">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-5">
                <br>
                <h1 class="m-0">Reporte de ventas</h1>
            </div><!-- /.col -->
            <div class="col-sm-7">
                <form id="form_filter" action="<?php echo $URL; ?>/app/controllers/reportes/obtener_fechas.php" method="get">
                    <div class="form-group row">
                        <div class="col-md-4 col-sm-6 mb-2">
                            <label for="start-date">Fecha de inicio:</label>
                            <input type="date" id="start-date" name="start-date" class="form-control" min="2020-01-01" max="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="col-md-4 col-sm-6 mb-2">
                            <label for="end-date">Fecha de fin:</label>
                            <input type="date" id="end-date" name="end-date" class="form-control" min="2020-01-01" max="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <input type="hidden" name="filter_true" value="1">
                        <div class="col-md-2 col-sm-6 mb-2">
                            <label>&nbsp;</label>
                            <button type="submit" id="filtro" class="btn btn-primary form-control"><i class="bi bi-funnel-fill"></i> Filtrar</button>
                        </div>
                        <div class="col-md-2 col-sm-6 mb-2" id="no_filter" style="display: none;">
                            <label>&nbsp;</label>
                            <a href="<?php echo $VIEWS ?>/reportes" class="btn btn-primary form-control"><i class="bi bi-funnel"></i> Quitar</a>
                        </div>

                        <div class="col-md-10 col-sm-6 mb-2" id="id_fechas" style="display: none;">
                            <i class="bi bi-info-circle text-danger"></i>
                            <span id="validar_fecha" class="text-danger"></span>
                        </div>
                    </div>
                </form>

                <script>
                    document.addEventListener('DOMContentLoaded', (event) => {
                        const form = document.getElementById('form_filter');
                        const input = document.getElementById('start-date');
                        const input2 = document.getElementById('end-date');

                        form.addEventListener('submit', function(event) {
                            const start_date = input.value;
                            const end_date = input2.value;

                            //Cantidad de dias entre las dos fechas
                            const dias = (new Date(end_date) - new Date(start_date)) / (1000 * 60 * 60 * 24);
                            if (start_date === '' || end_date === '') {
                                event.preventDefault(); // Evita que el formulario se envíe
                                validar_fecha.textContent = 'Seleccione un fecha de inicio y fin';
                                id_fechas.style.display = 'block';
                            } else {
                                if (dias < 0) {
                                    event.preventDefault(); // Evita que el formulario se envíe
                                    validar_fecha.textContent = 'La fecha de inicio no puede ser mayor a la fecha de fin';
                                    id_fechas.style.display = 'block';
                                } else if (dias > 365) {
                                    event.preventDefault(); // Evita que el formulario se envíe
                                    validar_fecha.textContent = 'El rango de fechas no puede ser mayor a un año';
                                    id_fechas.style.display = 'block';
                                } else {
                                    id_fechas.style.display = 'none';
                                }
                            }
                        });
                    });
                </script>

                <script>
                    <?php

                    if ($filter == 1) {

                    ?>
                        document.getElementById('no_filter').style.display = 'block';
                    <?php
                    }
                    ?>
                </script>

            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->

    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $cantidad_ventas ?></h3>
                            <p>Numero de de ventas</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3><?php echo $productos_vendidos ?></h3>

                            <p>Productos vendidos</p>
                        </div>
                        <div class="icon" style="position: absolute; bottom: 135px; right: 0px;">
                            <i class="bi bi-cart-check-fill text-white"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-ligth">
                        <div class="inner">
                            <h3><?php echo $servicios_brindados; ?></h3>

                            <p>Servicios brindados</p>
                        </div>
                        <div class="icon" style="position: absolute; bottom: 135px; right: 0px;">
                            <i class="bi bi-scissors"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>$<?php echo $total_vendido; ?></h3>

                            <p>Total vendido</p>
                        </div>
                        <div class="icon" style="position: absolute; bottom: 130px; right: 0px;">
                            <i class="bi bi-cash-coin"></i>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="bi bi-graph-up-arrow"></i>
                                    <?php echo $mensaje; ?>
                                </h3>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <canvas id="line-chart" style="height: 360px; width: 100%;"></canvas>
                            </div><!-- /.card-body -->
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-chart-pie mr-1"></i>
                                    <span id="chart-title">Productos vendidos por categorias</span>
                                </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" id="toggle-chart">
                                        <i class="fas fa-exchange-alt"></i> <span id="toggle-chart-label">Servicios</span>
                                    </button>
                                </div>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <canvas id="doughnut-chart" style="height: 360px; width: 100%;"></canvas>
                            </div><!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <script>
        var ctx = document.getElementById('line-chart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line', // Gráfico de líneas
            data: {
                labels: [<?php echo $arry_grafico[0] ?>], // Etiquetas del eje X
                datasets: [{
                    label: 'Total de ventas',
                    data: [<?php echo $arry_grafico[1] ?>], // Datos del primer conjunto
                    borderColor: 'rgba(75, 192, 192, 1)', // Color de la línea (verde)
                    backgroundColor: 'rgba(75, 192, 192, 0.5)', // Relleno transparente
                    borderWidth: 2,
                    tension: 0.4, // Curva de tensión
                    fill: true // No rellenar debajo de la línea
                }]
            },
            options: {
                responsive: true, // Hace que el gráfico sea responsive
                maintainAspectRatio: false, // Permite cambiar la relación de aspecto en pantallas más pequeñas
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: true, // Mostrar la leyenda
                        position: 'top' // Posición de la leyenda
                    }
                }
            }
        });
        var ctx = document.getElementById('doughnut-chart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut', // Gráfico de dona
            data: {
                labels: [<?php echo $arry_grafico3[0] ?>], // Etiquetas
                datasets: [{
                    label: 'Productos vendidos', // Título
                    data: [<?php echo $arry_grafico3[1] ?>], // Datos
                    backgroundColor: [
                        <?php echo $arry_grafico3[2] ?> // Colores de fondo
                    ],
                    borderColor: [
                        <?php echo $arry_grafico3[2] ?> // Colores de borde
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true, // Hace que el gráfico sea responsive
                maintainAspectRatio: false, // Permite cambiar la relación de aspecto en pantallas más pequeñas
                plugins: {
                    legend: {
                        display: true, // Mostrar la leyenda
                        position: 'top' // Posición de la leyenda
                    }
                }
            }
        });

        let isProducts = false; // Variable para saber si se están mostrando productos o servicios
        document.getElementById('toggle-chart').addEventListener('click', function() {
            if (isProducts) {
                myChart.data.labels = [<?php echo $arry_grafico3[0] ?>];
                myChart.data.datasets[0].label = 'Productos vendidos';
                myChart.data.datasets[0].data = [<?php echo $arry_grafico3[1] ?>];
                myChart.data.datasets[0].backgroundColor = [
                    <?php echo $arry_grafico3[2] ?>
                ];
                myChart.data.datasets[0].borderColor = [
                    <?php echo $arry_grafico3[2] ?>
                ];
                myChart.update();
                document.getElementById('chart-title').textContent = 'Productos vendidos por categorias';
                document.getElementById('toggle-chart-label').textContent = 'Servicios';
                isProducts = false;
            } else {
                myChart.data.labels = [<?php echo $arry_grafico_servicios[0] ?>];
                myChart.data.datasets[0].label = 'Servicios brindados';
                myChart.data.datasets[0].data = [<?php echo $arry_grafico_servicios[1] ?>];
                myChart.data.datasets[0].backgroundColor = [
                    <?php echo $arry_grafico_servicios[2] ?>
                ];
                myChart.data.datasets[0].borderColor = [
                    <?php echo $arry_grafico_servicios[2] ?>
                ];
                myChart.update();
                document.getElementById('chart-title').textContent = 'Servicios brindados por categorias';
                document.getElementById('toggle-chart-label').textContent = 'Productos';
                isProducts = true;
            }
        });
    </script>
</div>
<?php
include('../usuarios/layout/parte2.php');
?>
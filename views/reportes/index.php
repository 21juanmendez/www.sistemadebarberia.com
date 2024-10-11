<?php
include '../usuarios/layout/parte1.php';
include('../../app/controllers/reportes/reportes_filter.php');

?>

<div class="content">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <br>
                <h1 class="m-0">Reporte de ventas</h1>
            </div><!-- /.col -->
            <div class="col-sm-6 ">
                <form id="form_filter" action="<?php echo $URL; ?>/app/controllers/reportes/obtener_fechas.php" method="get">
                    <div class="form-group row">
                        <div class="col-md-4 col-sm-6 mb-2">
                            <label for="start-date">Fecha de inicio:</label>
                            <input type="date" id="start-date" name="start-date"  class="form-control">
                        </div>
                        <div class="col-md-4 col-sm-6 mb-2">
                            <label for="end-date">Fecha de fin:</label>
                            <input type="date" id="end-date" name="end-date" class="form-control">
                        </div>
                        <div class="col-md-2 col-sm-6 mb-2">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-primary form-control"><i class="bi bi-funnel-fill"></i> Filtrar</button>
                        </div>
                    </div>
                </form>
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
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-chart-pie mr-1"></i>
                                    <?php echo $mensaje; ?>
                                </h3>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <canvas id="line-chart" style="height: 350px; width: 100%;"></canvas>
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
                        label: 'Dataset 1',
                        data: [<?php echo $arry_grafico[1] ?>], // Datos del primer conjunto
                        borderColor: 'rgba(255, 99, 132, 1)', // Color de la línea (rojo)
                        backgroundColor: 'rgba(255, 99, 132, 0.2)', // Relleno transparente
                        borderWidth: 2,
                        fill: false // No rellenar debajo de la línea
                    },
                    {
                        label: 'Dataset 2',
                        data: [-80, -40, 0, 20, -60, 40, -100], // Datos del segundo conjunto
                        borderColor: 'rgba(54, 162, 235, 1)', // Color de la línea (azul)
                        backgroundColor: 'rgba(54, 162, 235, 0.2)', // Relleno transparente
                        borderWidth: 2,
                        fill: false // No rellenar debajo de la línea
                    }
                ]
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
    </script>
</div>
<?php
include('../usuarios/layout/parte2.php');
?>
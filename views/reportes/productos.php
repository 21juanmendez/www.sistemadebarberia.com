<?php
include '../usuarios/layout/parte1.php';
include('../../app/controllers/reportes/reporte_productos.php');
?>

<div class="content">
    <div class="container-fluid">
        <h1 class="m-0">Reporte de inventario de productos</h1>
        <br>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="bi bi-clipboard-data"></i>
                                    Reporte de inventarios de productos
                                </h3>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <canvas id="line-chart" style="height: 520px; width: 100%;"></canvas>
                            </div><!-- /.card-body -->
                        </div>
                    </div>



                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card p-3">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <i class="bi bi-list-stars"></i>
                                            <span id="chart-title">Top 5 productos mas vendidos del ultimo mes</span>
                                        </h3>
                                    </div><!-- /.card-header -->
                                    <div class="col-md-12 mt-3">

                                        <?php

                                        foreach ($top_prod as $producto) {
                                        ?>
                                            <div class="progress-group">
                                                <?php echo $producto['nombre']; ?>
                                                <span class="float-right"><b><?php echo $producto['cantidad'] ?></b>/<?php echo $productos_vendidos ?></span>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar" style="width: <?php echo ($producto['cantidad'] / $productos_vendidos) * 100 ?>%; background-color: <?php echo $producto['color']; ?>"></div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <!-- /.progress-group -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card p-3" style="height: 286px; width: 100%; overflow: hidden;">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <i class="bi bi-list-stars"></i>
                                            <span id="chart-title">Productos proximos a agotarse</span>
                                        </h3>
                                    </div><!-- /.card-header -->
                                    <div class="col-md-12 mt-2" style="overflow-y: auto; max-height: calc(100% - 56px);">
                                        <table class="table table-bordered">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th>Producto</th>
                                                    <th>Stock</th>
                                                    <th>Stock Minimo</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($stocks as $stock) {
                                                    if ($stock['stock'] <= $stock['stock_minimo']) {
                                                ?>

                                                        <tr>
                                                            <td><?php echo $stock['nombre_producto'] ?></td>
                                                            <td><?php echo $stock['stock'] ?></td>
                                                            <td><?php echo $stock['stock_minimo'] ?></td>
                                                        </tr>
                                                <?php
                                                    }
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
        </section>
    </div>
</div>
<script>
    var ctx = document.getElementById('line-chart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [<?php echo $arry_grafico[0]; ?>],
            datasets: [{
                    label: 'Stock Mínimo',
                    backgroundColor: 'rgba(255, 0, 0, 0)',
                    borderColor: 'rgba(9, 10, 57, 1)',
                    borderWidth: 1,
                    data: [<?php echo $arry_grafico[2]; ?>],
                    borderWidth: {
                        top: 2,
                        left: 0,
                        right: 0,
                        bottom: 0
                    },
                    fill: false
                },
                {
                    label: 'Stock Disponible',
                    //colocar negro de fondo
                    backgroundColor: 'rgba(255, 0, 0, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 0,
                    data: [<?php echo $arry_grafico[1]; ?>],
                    borderWidth: {
                        top: 0,
                        left: 0,
                        right: 0,
                        bottom: 0
                    },
                    fill: false
                },
                {
                    label: 'Stock Máximo',
                    backgroundColor: 'rgba(75, 192, 192, 0)',
                    borderColor: 'rgba(0,0, 0, 1)',
                    borderWidth: 1,
                    data: [<?php echo $arry_grafico[3]; ?>],
                    borderWidth: {
                        top: 2,
                        left: 0,
                        right: 0,
                        bottom: 0
                    },
                    fill: true
                }
            ]
        },
        options: {
            responsive: true, // Hace que el gráfico sea responsive
            maintainAspectRatio: false,
            scales: {
                x: {
                    stacked: true,
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false,
                }
            }
        }
    });
</script>
<?php
include('../usuarios/layout/parte2.php');
?>
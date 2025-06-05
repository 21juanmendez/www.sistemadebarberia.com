<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/reportes/reporte_comentarios.php');
?>
<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <h3 class="card-title"><i class="fas fa-comments"></i> Reporte de Comentarios de Clientes</h3>
    </div>
    <!-- Filtro por fechas -->
    <div class="card-body border-bottom">
        <form method="get" class="row g-2 align-items-center">
            <div class="col-auto">
                <label for="desde" class="form-label m-0"><strong>Desde:</strong></label>
                <input type="date" id="desde" name="desde" value="<?= $_GET['desde'] ?? '' ?>" class="form-control form-control-sm" required>
            </div>
            <div class="col-auto">
                <label for="hasta" class="form-label m-0"><strong>Hasta:</strong></label>
                <input type="date" id="hasta" name="hasta" value="<?= $_GET['hasta'] ?? '' ?>" class="form-control form-control-sm" required>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-sm btn-primary mt-4">
                    <i class="fas fa-filter"></i> Filtrar
                </button>
                <?php if (isset($_GET['desde'], $_GET['hasta'])): ?>
                    <a href="comentarios.php" class="btn btn-sm btn-secondary mt-4">Quitar filtro</a>
                <?php endif; ?>
            </div>
        </form>
    </div>


    <!-- KPIs Estilo Moderno -->
    <div class="row row-cols-1 row-cols-md-4 g-3 px-3 py-3 text-white">
        <div class="col">
            <div class="card h-100 bg-primary rounded-3 shadow-sm d-flex flex-row align-items-center justify-content-between p-3">
                <div>
                    <small class="text-white-50">Total comentarios</small>
                    <h4 class="fw-bold mb-0"><?= $totalComentarios ?></h4>
                </div>
                <i class="fas fa-comments fa-2x"></i>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 bg-success rounded-3 shadow-sm d-flex flex-row align-items-center justify-content-between p-3">
                <div>
                    <small class="text-white-50">Promedio</small>
                    <h4 class="fw-bold mb-0"><?= $promedioCalificacion ?> ★</h4>
                </div>
                <i class="fas fa-star fa-2x"></i>
            </div>
        </div>

        <div class="col">
            <div class="card h-100" style="background-color: #7b2cbf; color: white; border: none;">
                <div class="d-flex flex-row align-items-center justify-content-between p-3">
                    <div>
                        <small class="text-white-50">Más comentado</small>
                        <h5 class="fw-bold mb-0"><?= $servicioPopular ?></h5>
                    </div>
                    <i class="fas fa-chart-line fa-2x"></i>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 bg-dark rounded-3 shadow-sm d-flex flex-row align-items-center justify-content-between p-3">
                <div>
                    <small class="text-white-50">Último</small>
                    <h5 class="fw-bold mb-0"><?= date("d/m/Y", strtotime($fechaUltimo)) ?></h5>
                </div>
                <i class="far fa-clock fa-2x"></i>
            </div>
        </div>
    </div>
 

<!-- Fila con tabla de comentarios y negativos a la par -->
<div class="row mx-2 mb-5">

    <!-- Tabla de comentarios -->
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="fas fa-table"></i> Detalle de comentarios</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover align-middle text-center" id="example11">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Cliente</th>
                            <th>Servicio</th>
                            <th>Título</th>
                            <th>Comentario</th>
                            <th>Calificación</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($comentarios as $comentario): ?>
                            <tr class="<?= $comentario['calificacion'] <= 2 ? 'table-danger' : ($comentario['calificacion'] == 3 ? 'table-warning' : 'table-success') ?>">
                                <td><?= $i++ ?></td>
                                <td><?= htmlspecialchars($comentario['nombre_completo']) ?></td>
                                <td><span class="badge bg-secondary"><?= htmlspecialchars($comentario['nombre_servicio']) ?></span></td>
                                <td><?= htmlspecialchars($comentario['titulo']) ?></td>
                                <td><?= htmlspecialchars($comentario['comentario']) ?></td>
                                <td data-order="<?= $comentario['calificacion'] ?>">
                                    <?php for ($j = 1; $j <= 5; $j++): ?>
                                        <?= $j <= $comentario['calificacion'] ? '★' : '☆' ?>
                                    <?php endfor ?>
                                </td>
                                <td data-order="<?= date("Y-m-d", strtotime($comentario['fecha'])) ?>">
                                    <?= date("d-m-Y", strtotime($comentario['fecha'])) ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Comentarios Negativos Destacados con mismo estilo -->
    <div class="col-md-4">
        <div class="card h-100 shadow-sm">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="fas fa-thumbs-down"></i> Comentarios Negativos Destacados</h5>
            </div>
            <div class="card-body">
                <?php if (count($comentariosNegativos)): ?>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($comentariosNegativos as $neg): ?>
                            <li class="list-group-item">
                                <strong><?= htmlspecialchars($neg['nombre_servicio']) ?>:</strong> <?= htmlspecialchars($neg['comentario']) ?>
                                <br><small class="text-muted"><?= date("d/m/Y", strtotime($neg['fecha'])) ?></small>
                            </li>
                        <?php endforeach ?>
                    </ul>
                <?php else: ?>
                    <p class="text-muted mb-0">Sin comentarios negativos recientes.</p>
                <?php endif ?>
            </div>
        </div>
    </div>

</div>



    <!-- Gráficas -->
    <div class="card mx-3 mb-5 shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0"><i class="fas fa-chart-line"></i> Visualizaciones</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Distribución de Calificaciones -->
                <div class="col-md-8 mb-4">
                    <div class="card shadow-sm h-100 p-3">
                        <h6 class="text-muted mb-2"><i class="fas fa-star-half-alt"></i> Distribución de Calificaciones</h6>
                        <canvas id="graficoCalificaciones" height="200"></canvas>
                    </div>
                </div>
                <!-- Comentarios por Servicio (más pequeño y centrado) -->
                <div class="col-md-4 mb-4 mx-auto">
                    <div class="card shadow-sm h-100 p-3 text-center">
                        <h6 class="text-muted mb-2"><i class="far fa-clock"></i> Comentarios por Servicio</h6>
                        <div class="d-flex justify-content-center">
                            <div style="max-width: 300px; width: 100%;">
                                <canvas id="graficoServicios" height="220"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Comentarios por Mes -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm h-100 p-3">
                        <h6 class="text-muted mb-2"><i class="fas fa-calendar-alt"></i> Comentarios por Mes</h6>
                        <canvas id="graficoMensual" height="200"></canvas>
                    </div>
                </div>
                <!-- Promedio por Servicio -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm h-100 p-3">
                        <h6 class="text-muted mb-2"><i class="fas fa-chart-bar"></i> Promedio por Servicio</h6>
                        <canvas id="graficoPromedios" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Estadísticas adicionales 
<div class="card mx-3 mb-5 shadow-sm">
    <div class="card-header bg-light">
        <h5 class="mb-0"><i class="fas fa-star"></i> Insights adicionales</h5>
    </div>
    <div class="card-body row g-4">

        <!-- Top 3 Servicios Mejor Calificados 
        <div class="col-md-6">
            <div class="card h-100 border-success">
                <div class="card-header bg-success text-white">
                    <i class="fas fa-crown"></i> Top 3 Servicios Mejor Calificados
                </div>
                <ul class="list-group list-group-flush">
                    <?php if (count($top3Servicios)): ?>
                        <?php foreach ($top3Servicios as $servicio): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?= htmlspecialchars($servicio['nombre_servicio']) ?>
                                <span class="badge bg-success rounded-pill"><?= $servicio['promedio'] ?> ★</span>
                            </li>
                        <?php endforeach ?>
                    <?php else: ?>
                        <li class="list-group-item">No hay datos suficientes</li>
                    <?php endif ?>
                </ul>
            </div>
        </div>-->

        <!-- Comentarios Negativos Destacados 
        <div class="col-md-6">
            <div class="card h-100 border-danger">
                <div class="card-header bg-danger text-white">
                    <i class="fas fa-thumbs-down"></i> Comentarios Negativos Destacados
                </div>
                <ul class="list-group list-group-flush">
                    <?php if (count($comentariosNegativos)): ?>
                        <?php foreach ($comentariosNegativos as $neg): ?>
                            <li class="list-group-item">
                                <strong><?= htmlspecialchars($neg['nombre_servicio']) ?>:</strong> <?= htmlspecialchars($neg['comentario']) ?>
                                <br><small class="text-muted"><?= date("d/m/Y", strtotime($neg['fecha'])) ?></small>
                            </li>
                        <?php endforeach ?>
                    <?php else: ?>
                        <li class="list-group-item">Sin comentarios negativos recientes.</li>
                    <?php endif ?>
                </ul>
            </div>
        </div>-->

        <!-- Comparativa mes actual vs anterior 
        <div class="col-12">
            <div class="card border-info">
                <div class="card-header bg-info text-white">
                    <i class="fas fa-chart-line"></i> Comparativa de Comentarios (Mes Actual vs Anterior)
                </div>
                <div class="card-body d-flex justify-content-around">
                    <?php foreach ($comparativaMeses as $mes => $total): ?>
                        <div class="text-center">
                            <h6 class="mb-1"><?= date('F Y', strtotime($mes . "-01")) ?></h6>
                            <span class="badge bg-info fs-5"><?= $total ?></span>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div>-->

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const calificaciones = <?= json_encode($calificacionesDistribucion) ?>;
    const servicios = <?= json_encode($comentariosPorServicio) ?>;
    const mensual = <?= json_encode($comentariosPorMes) ?>;
    const promedios = <?= json_encode($promediosPorServicio) ?>;

    new Chart(document.getElementById('graficoCalificaciones'), {
        type: 'bar',
        data: {
            labels: calificaciones.map(e => e.calificacion + ' ★'),
            datasets: [{
                label: 'Cantidad',
                data: calificaciones.map(e => e.total),
                backgroundColor: ['#dc3545', '#fd7e14', '#ffc107', '#28a745', '#198754']
            }]
        }
    });

    new Chart(document.getElementById('graficoServicios'), {
        type: 'doughnut',
        data: {
            labels: servicios.map(e => e.nombre_servicio),
            datasets: [{
                data: servicios.map(e => e.total),
                backgroundColor: ['#0d6efd', '#20c997', '#ffc107', '#dc3545', '#6f42c1']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '60%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 15,
                        padding: 15
                    }
                }
            },
            layout: {
                padding: 10
            }
        }
    });
    new Chart(document.getElementById('graficoMensual'), {
        type: 'line',
        data: {
            labels: mensual.map(e => e.mes),
            datasets: [{
                label: 'Comentarios por mes',
                data: mensual.map(e => e.total),
                borderColor: '#0d6efd',
                backgroundColor: 'rgba(13,110,253,0.1)',
                fill: true,
                tension: 0.3
            }]
        }
    });

    new Chart(document.getElementById('graficoPromedios'), {
        type: 'bar',
        data: {
            labels: promedios.map(e => e.nombre_servicio),
            datasets: [{
                label: 'Promedio de calificación',
                data: promedios.map(e => e.promedio),
                backgroundColor: '#20c997'
            }]
        }
    });
</script>

<?php include('../usuarios/layout/parte2.php'); ?>
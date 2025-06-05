<?php
include '../usuarios/layout/parte1.php';
include '../../app/controllers/reportes/reporte_clientes.php';
?>

<div class="content">
    <div class="container-fluid">
        <h2 class="mb-1 text-center">✂️ Sistema de Reportes - Barbería</h2>
        <p class="text-center text-muted">Panel de control y análisis de clientes</p>

        <!-- Tarjetas de Estadísticas -->
        <div class="row mb-4">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?php echo $total_clientes ?></h3>
                        <p>Clientes Registrados</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-stalker"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?php echo $total_frecuentes ?></h3>
                        <p>Clientes Frecuentes</p>
                    </div>
                    <div class="icon" style="position: absolute; bottom: 135px; right: 0px;">
                        <i class="bi bi-person-plus-fill"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?php echo $total_sin_compras ?></h3>
                        <p>Clientes sin Compras</p>
                    </div>
                    <div class="icon" style="position: absolute; bottom: 135px; right: 0px;">
                        <i class="bi bi-person-dash-fill"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?php echo $total_inactivos ?></h3>
                        <p>Inactivos +30 días</p>
                    </div>
                    <div class="icon" style="position: absolute; bottom: 135px; right: 0px;">
                        <i class="bi bi-person-x-fill"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráficas -->
        <div class="row mb-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-trophy"></i> Top 5 Clientes por Gasto</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="chartTopClientes" width="400" height="186"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-chart-pie"></i> Distribución por Nivel</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="chartNiveles" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>



        <!-- Top Clientes -->
        <div class="row mb-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-chart-line"></i> Actividad por Mes</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="chartMeses" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-star"></i> Resumen de Puntos por Nivel</h3>
                    </div>
                    <div class="card-body">
                        <?php foreach ($promedio_puntos as $nivel): ?>
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-info"><i class="fas fa-users"></i></span>
                                <div class="info-box-content" style="height: 110px;">
                                    <span class="info-box-text"><?php echo $nivel['nivel_cliente']; ?></span>
                                    <span class="info-box-number"><?php echo round($nivel['promedio_puntos']); ?> pts promedio</span>
                                    <span class="progress-description"><?php echo $nivel['cantidad_clientes']; ?> clientes</span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de Clientes -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-table"></i> Lista Detallada de Clientes</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-success btn-sm" onclick="exportarExcel()">
                        <i class="fas fa-file-excel"></i> Exportar Excel
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form method="GET" action="">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="nivel">Nivel de Cliente:</label>
                            <select name="nivel" id="nivel" class="form-control">
                                <option value="">Todos los niveles</option>
                                <option value="No frecuente" <?php echo ($filtro_nivel == 'No frecuente') ? 'selected' : ''; ?>>No frecuente</option>
                                <option value="Regular" <?php echo ($filtro_nivel == 'Regular') ? 'selected' : ''; ?>>Regular</option>
                                <option value="Frecuente" <?php echo ($filtro_nivel == 'Frecuente') ? 'selected' : ''; ?>>Frecuente</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="fecha_desde">Fecha Desde:</label>
                            <input type="date" name="fecha_desde" id="fecha_desde" class="form-control" value="<?php echo $filtro_fecha_desde; ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="fecha_hasta">Fecha Hasta:</label>
                            <input type="date" name="fecha_hasta" id="fecha_hasta" class="form-control" value="<?php echo $filtro_fecha_hasta; ?>">
                        </div>
                        <div class="col-md-1">
                            <label>&nbsp;</label>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fas fa-filter"></i> Filtrar
                                </button>
                            </div>
                        </div>
                        <div class="col-md-2" id="noFilter" style="display: none;">
                            <label>&nbsp;</label>
                            <div class="form-group">
                                <a href="clientes.php" class="btn btn-secondary btn-block">
                                    <i class="fas fa-times"></i> Eliminar Filtro
                                </a>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const nivelSelect = document.getElementById('nivel');
                            const noFilterDiv = document.getElementById('noFilter');

                            // Mostrar/ocultar botón de eliminar filtro
                            nivelSelect.addEventListener('change', function() {
                                if (this.value || document.getElementById('fecha_desde').value || document.getElementById('fecha_hasta').value) {
                                    noFilterDiv.style.display = 'block';
                                } else {
                                    noFilterDiv.style.display = 'none';
                                }
                            });

                            // Inicializar visibilidad al cargar la página
                            if (nivelSelect.value || document.getElementById('fecha_desde').value || document.getElementById('fecha_hasta').value) {
                                noFilterDiv.style.display = 'block';
                            } else {
                                noFilterDiv.style.display = 'none';
                            }
                        });
                    </script>
                </form>
                <div class="table-responsive">
                    <table id="tablaClientes" class="table table-bordered table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nombre Completo</th>
                                <th>Teléfono</th>
                                <th>Email</th>
                                <th>Nivel</th>
                                <th>Puntos</th>
                                <th>Última Visita</th>
                                <th>Total Compras</th>
                                <th>Total Gastado</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($clientes as $cliente): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($cliente['nombre_completo']); ?></td>
                                    <td><?php echo htmlspecialchars($cliente['telefono']); ?></td>
                                    <td><?php echo htmlspecialchars($cliente['email']); ?></td>
                                    <td>
                                        <span class="badge <?php
                                                            echo $cliente['nivel_cliente'] == 'Frecuente' ? 'badge-success' : ($cliente['nivel_cliente'] == 'Regular' ? 'badge-warning' : 'badge-secondary');
                                                            ?>">
                                            <?php echo $cliente['nivel_cliente']; ?>
                                        </span>
                                    </td>
                                    <td><?php echo $cliente['acumulado_puntos']; ?></td>
                                    <td><?php echo $cliente['fecha_ultima_visita'] ? date('d/m/Y', strtotime($cliente['fecha_ultima_visita'])) : 'Sin visitas'; ?></td>
                                    <td><?php echo $cliente['total_compras']; ?></td>
                                    <td>$<?php echo number_format($cliente['total_gastado'], 2); ?></td>
                                    <td>
                                        <?php if ($cliente['dias_inactivo'] > 60 || is_null($cliente['fecha_ultima_visita'])): ?>
                                            <span class="badge badge-danger">Inactivo</span>
                                        <?php elseif ($cliente['dias_inactivo'] > 30) : ?>
                                            <span class="badge badge-warning">En riesgo</span>
                                        <?php else: ?>
                                            <span class="badge badge-success">Activo</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
    // $(document).ready(function() {
    //     // Inicializar DataTable
    //     $('#tablaClientes').DataTable({
    //         "language": {
    //             "sProcessing": "Procesando...",
    //             "sLengthMenu": "Mostrar _MENU_ registros",
    //             "sZeroRecords": "No se encontraron resultados",
    //             "sEmptyTable": "Ningún dato disponible en esta tabla",
    //             "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    //             "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
    //             "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
    //             "sSearch": "Buscar:",
    //             "oPaginate": {
    //                 "sFirst": "Primero",
    //                 "sLast": "Último",
    //                 "sNext": "Siguiente",
    //                 "sPrevious": "Anterior"
    //             }
    //         },
    //         "pageLength": 25,
    //         "order": [
    //             [6, "desc"]
    //         ] // Ordenar por fecha de última visita
    //     });
    // });

    // Gráfica de distribución por niveles
    const ctxNiveles = document.getElementById('chartNiveles').getContext('2d');
    const chartNiveles = new Chart(ctxNiveles, {
        type: 'doughnut',
        data: {
            labels: <?php echo $niveles_labels; ?>,
            datasets: [{
                data: <?php echo $niveles_data; ?>,
                backgroundColor: ['#28a745', '#ffc107', '#dc3545', '#6c757d'],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Gráfica de actividad por mes
    const ctxMeses = document.getElementById('chartMeses').getContext('2d');
    const chartMeses = new Chart(ctxMeses, {
        type: 'line',
        data: {
            labels: <?php echo $meses_labels; ?>,
            datasets: [{
                label: 'Clientes Activos',
                data: <?php echo $meses_data; ?>,
                borderColor: '#007bff',
                backgroundColor: 'rgba(0, 123, 255, 0.1)',
                borderWidth: 2,
                fill: true
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Gráfica de top clientes
    const ctxTop = document.getElementById('chartTopClientes').getContext('2d');
    const chartTop = new Chart(ctxTop, {
        type: 'bar',
        data: {
            labels: <?php echo $top_clientes_labels; ?>,
            datasets: [{
                label: 'Total Gastado $',
                data: <?php echo $top_clientes_data; ?>,
                backgroundColor: <?php echo $top_clientes_colores ?>,
                borderColor: <?php echo $top_clientes_colores ?>,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    function exportarExcel() {
        // Implementar exportación a Excel
        window.location.href = 'exportar_clientes.php?nivel=<?php echo $filtro_nivel; ?>&fecha_desde=<?php echo $filtro_fecha_desde; ?>&fecha_hasta=<?php echo $filtro_fecha_hasta; ?>';
    }
</script>

<?php
include('../usuarios/layout/parte2.php');
?>
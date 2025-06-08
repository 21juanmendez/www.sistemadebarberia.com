<?php
include '../usuarios/layout/parte1.php';
include '../../app/controllers/reportes/reporte_financiero.php';
$meses = [
    '01' => 'Enero',
    '02' => 'Febrero',
    '03' => 'Marzo',
    '04' => 'Abril',
    '05' => 'Mayo',
    '06' => 'Junio',
    '07' => 'Julio',
    '08' => 'Agosto',
    '09' => 'Septiembre',
    '10' => 'Octubre',
    '11' => 'Noviembre',
    '12' => 'Diciembre'
];

$mes_actual = $_GET['mes'] ?? date('m');
$anio_actual = $_GET['anio'] ?? date('Y');
$periodo = $meses[$mes_actual] . ' ' . $anio_actual;
?>
<style>
    .gradient-card {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        border: none;
    }

    .gradient-card-blue {
        background: linear-gradient(135deg, #007bff 0%, #6610f2 100%);
        color: white;
        border: none;
    }

    .gradient-card-purple {
        background: linear-gradient(135deg, #6f42c1 0%, #e83e8c 100%);
        color: white;
        border: none;
    }

    .gradient-card-orange {
        background: linear-gradient(135deg, #fd7e14 0%, #dc3545 100%);
        color: white;
        border: none;
    }

    .metric-card {
        transition: transform 0.2s;
    }

    .metric-card:hover {
        transform: translateY(-5px);
    }

    .progress-custom {
        height: 8px;
    }

    .alert-custom {
        border-left: 4px solid;
    }

    .alert-warning-custom {
        border-left-color: #ffc107;
        background-color: #fff3cd;
    }

    .alert-success-custom {
        border-left-color: #28a745;
        background-color: #d4edda;
    }

    .alert-danger-custom {
        border-left-color: #dc3545;
        background-color: #f8d7da;
    }

    .footer-executive {
        background: linear-gradient(135deg, #343a40 0%, #495057 100%);
        color: white;
    }

    .nav-tabs .nav-link.active {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }

    .table-financial {
        font-size: 0.9rem;
    }

    .icon-metric {
        font-size: 1.5rem;
        opacity: 0.8;
    }
</style>
<div class="container-fluid py-4">

    <div class="d-flex flex-wrap justify-content-between align-items-end mb-4">
        <div>
            <h1 class="display-5 fw-bold text-dark m-0">
                <i class="bi bi-graph-up-arrow text-primary me-2"></i>
                Reporte Financiero
            </h1>
            <h3 class="text-muted">Barbería Área 51 - Período: <?= $periodo ?></h3>
        </div>
        <form class="row gx-2 gy-1 align-items-end" method="get" action="">
            <div class="col-auto">
                <label for="mes" class="form-label mb-1">Mes</label>
                <select class="form-select form-select-md" id="mes" name="mes" required>
                    <option value="">Seleccionar Mes</option>
                    <?php foreach ($meses as $num => $nombre): ?>
                        <option value="<?= $num ?>" <?= ($num === $mes_actual) ? 'selected' : '' ?>><?= $nombre ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-auto">
                <label for="anio" class="form-label mb-1">Año</label>
                <select class="form-select form-select-md" id="anio" name="anio" required>
                    <option value="">Seleccionar Año</option>
                    <?php
                    for ($a = date('Y'); $a >= date('Y') - 5; $a--):
                        $selected = ($a == $anio_actual) ? 'selected' : '';
                        echo "<option value=\"$a\" $selected>$a</option>";
                    endfor;
                    ?>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-md btn-primary">
                    <i class="bi bi-funnel me-1"></i>Filtrar
                </button>
            </div>
        </form>
    </div>

    <!-- Key Metrics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="card gradient-card metric-card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="card-title mb-2 opacity-75" style="width: 100%;">Ingresos Totales</h6>
                            <h2 class="fw-bold mb-1">$<?= number_format($ingresos_totales, 2) ?></h2>
                            <small class="opacity-75">
                                <i class="bi bi-trending-<?= $cambio_ingresos >= 0 ? 'up' : 'down' ?> me-1"></i>
                                <?= $cambio_ingresos >= 0 ? '+' : '' ?><?= number_format($cambio_ingresos, 1) ?>% vs mes anterior
                            </small>
                        </div>
                        <i class="bi bi-currency-dollar icon-metric"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card gradient-card-orange metric-card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="card-title mb-2 opacity-75" style="width: 100%;">Egresos Totales</h6>
                            <div class="row"></div>
                            <h2 class="fw-bold mb-1">$<?= number_format($egresos_totales, 2) ?></h2>
                            <small class="opacity-75">
                                <i class="bi bi-trending-<?= $cambio_egresos >= 0 ? 'up' : 'down' ?> me-1"></i>
                                <?= $cambio_egresos >= 0 ? '+' : '' ?><?= number_format($cambio_egresos, 1) ?>% vs mes anterior
                            </small>
                        </div>
                        <i class="bi bi-currency-exchange icon-metric"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card gradient-card-blue metric-card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="card-title mb-2 opacity-75" style="width: 100%;">Utilidad Neta</h6>
                            <h2 class="fw-bold mb-1">$<?= number_format($utilidad_neta, 2) ?></h2>
                            <small class="opacity-75">Margen: <?= number_format($margen_utilidad, 1) ?>%</small>
                        </div>
                        <i class="bi bi-bullseye icon-metric"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card gradient-card-purple metric-card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="card-title mb-2 opacity-75" style="width: 100%;">Clientes Atendidos</h6>
                            <h2 class="fw-bold mb-1"><?= number_format($clientes_atendidos) ?></h2>
                            <small class="opacity-75">Ticket promedio: $<?= number_format($ticket_promedio, 2) ?></small>
                        </div>
                        <i class="bi bi-people icon-metric"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Información adicional -->
    <div class="row mb-1">
        <div class="col-12">
            <div class="alert alert-light">
                <i class="bi bi-info-circle me-2"></i>
                <strong>Estado del período:</strong>
                <?php if ($utilidad_neta > 0): ?>
                    <span class="text-success">Período rentable con utilidad de $<?= number_format($utilidad_neta, 2) ?></span>
                <?php else: ?>
                    <span class="text-danger">Período con pérdidas de $<?= number_format(abs($utilidad_neta), 2) ?></span>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- <pre>
                            <?php
                            echo json_encode($detalle_servicios, JSON_PRETTY_PRINT);
                            echo json_encode($detalle_productos, JSON_PRETTY_PRINT);
                            echo json_encode($servicios_rentables, JSON_PRETTY_PRINT);
                            ?>
                        </pre> -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <!-- Header -->
                <div class="card-header bg-info text-white">
                    <h3 class="mb-0"><i class="bi bi-journal-text me-2"></i>Detalle Financiero del Período</h3>
                </div>

                <div class="card-body" style="font-size: 1.3rem;">
                    <!-- INGRESOS -->
                    <h4 class="text-success mb-3"><i class="bi bi-graph-up me-2"></i>Ingresos</h4>

                    <!-- Servicios -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between fw-bold mb-2">
                            <span>Servicios</span>
                            <span>$<?= number_format($ingresos_servicios, 2) ?></span>
                        </div>

                        <div class="ms-3 text-muted">

                            <?php foreach ($detalle_servicios as $servicio): ?>
                                <div class="d-flex justify-content-between">
                                    <span>• <?= $servicio['servicio'] ?></span>
                                    <span class="mb-2">$<?= number_format($servicio['total_servicio'], 2) ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Productos -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between fw-bold mb-2">
                            <span>Productos</span>
                            <span>$<?= number_format($ingresos_productos, 2) ?></span>
                        </div>
                        <div class="ms-3 text-muted">
                            <?php foreach ($detalle_productos as $producto): ?>
                                <div class="d-flex justify-content-between">
                                    <span>• <?= $producto['categoria'] ?></span>
                                    <span class="mb-2">$<?= number_format($producto['total_ventas'], 2) ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Total Ingresos -->
                    <div class="d-flex justify-content-between fw-bold text-success border-top pt-3 mb-4">
                        <span>Total Ingresos</span>
                        <span>$<?= number_format($ingresos_totales, 2) ?></span>
                    </div>

                    <!-- GASTOS -->
                    <h4 class="text-danger mb-3"><i class="bi bi-graph-down-arrow me-2"></i>Gastos</h4>

                    <?php foreach ($gastos_por_categoria as $categoria): ?>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between fw-bold mb-2">
                                <span><?= $categoria['categoria'] ?></span>
                                <span>$<?= number_format($categoria['total_categoria'], 2) ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <!-- Total Gastos -->
                    <div class="d-flex justify-content-between fw-bold text-danger border-top pt-3 mb-4">
                        <span>Total Gastos</span>
                        <span>$<?= number_format($egresos_totales, 2) ?></span>
                    </div>

                    <!-- UTILIDAD NETA -->
                    <div class="rounded p-3 d-flex justify-content-between align-items-center fw-bold fs-4"
                        style="background-color: rgba(173, 216, 230, 0.3); border-left: 5px solid #17a2b8;">
                        <span>Utilidad Neta</span>
                        <span><i class="bi bi-cash-coin me-1"></i> $<?= number_format($utilidad_neta, 2) ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row g-4 mb-4 d-flex">
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0">Servicios Más Rentables</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($top_servicios)): ?>
                        <?php foreach ($top_servicios as $servicio): ?>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <div class="fw-bold"><?= htmlspecialchars($servicio['nombre_servicio']) ?></div>
                                    <small class="text-muted">Ingreso: $<?= formatearMoneda($servicio['ingreso_total']) ?></small>
                                </div>
                                <span class="badge bg-info"><?= $servicio['veces_vendido'] ?> Veces vendido</span>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-muted">No hay datos de servicios para este período</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0">Productos Top</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($top_productos)): ?>
                        <?php foreach ($top_productos as $producto): ?>
                            <?php
                            $margen = number_format($producto['margen'], 2);
                            $badge_class = $margen >= 80 ? 'bg-success' : ($margen >= 70 ? 'bg-primary' : 'bg-warning');
                            ?>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <div class="fw-bold"><?= htmlspecialchars($producto['producto']) ?></div>
                                    <small class="text-muted">Ingreso: $<?= formatearMoneda($producto['ingreso_total']) ?></small>
                                </div>
                                <span class="badge <?= $badge_class ?>"><?= $margen ?>% margen</span>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-muted">No hay datos de productos para este período</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>


    <div class="row g-4 mb-4 d-flex">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0">Indicadores de Rentabilidad</h5>
                </div>
                <div class="card-body d-flex flex-column justify-content-center">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Margen Bruto</span>
                            <span class="fw-bold"><?= formatearPorcentaje($margen_bruto) ?>%</span>
                        </div>
                        <div class="progress progress-custom">
                            <div class="progress-bar <?= obtenerClaseProgreso($margen_bruto) ?>"
                                style="width: <?= min($margen_bruto, 100) ?>%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Margen Operativo</span>
                            <span class="fw-bold"><?= formatearPorcentaje($margen_operativo) ?>%</span>
                        </div>
                        <div class="progress progress-custom">
                            <div class="progress-bar <?= obtenerClaseProgreso($margen_operativo) ?>"
                                style="width: <?= min(max($margen_operativo, 0), 100) ?>%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>ROI</span>
                            <span class="fw-bold"><?= formatearPorcentaje($roi) ?>%</span>
                        </div>
                        <div class="progress progress-custom">
                            <div class="progress-bar <?= obtenerClaseProgreso($roi) ?>"
                                style="width: <?= min(abs($roi), 100) ?>%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0">Indicadores de Clientes</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="text-center p-3 bg-primary bg-opacity-10 rounded">
                                <h4 class="fw-bold text-white"><?= number_format($total_clientes) ?></h4>
                                <small>Clientes Totales</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center p-3 bg-success bg-opacity-10 rounded">
                                <h4 class="fw-bold text-white">$<?= formatearMoneda($ticket_promedio) ?></h4>
                                <small>Ticket Promedio</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center p-3 bg-info bg-opacity-10 rounded">
                                <h4 class="fw-bold text-white"><?= number_format($clientes_nuevos) ?></h4>
                                <small>Clientes Nuevos</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center p-3 bg-warning bg-opacity-10 rounded">
                                <h4 class="fw-bold text-white"><?= formatearPorcentaje($tasa_recurrencia) ?>%</h4>
                                <small>Recurrencia</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include '../usuarios/layout/parte2.php';
?>
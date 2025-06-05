<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/promociones/controller_puntos.php');
include('mensaje.php');
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><b>LISTADO DE PUNTOS CANJEADOS</b></h3>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCanjearPuntos">
                                <i class="bi bi-plus-lg"></i> Canjear puntos
                            </a>
                        </div>
                        <div class="col-md-6 text-end">
                            <!-- Filtros por estado -->
                            <div class="btn-group" role="group" aria-label="Filtros por estado">
                                <a href="?estado=todos" class="btn btn-outline-secondary <?= $filtroEstado === 'todos' ? 'active' : '' ?>">
                                    Todos (<?= $conteoTotal ?>)
                                </a>
                                <a href="?estado=generado" class="btn btn-outline-info <?= $filtroEstado === 'generado' ? 'active' : '' ?>">
                                    Generado (<?= isset($conteos['generado']) ? $conteos['generado'] : 0 ?>)
                                </a>
                                <a href="?estado=usado" class="btn btn-outline-success <?= $filtroEstado === 'usado' ? 'active' : '' ?>">
                                    Usado (<?= isset($conteos['usado']) ? $conteos['usado'] : 0 ?>)
                                </a>
                                <a href="?estado=expirado" class="btn btn-outline-danger <?= $filtroEstado === 'expirado' ? 'active' : '' ?>">
                                    Expirado (<?= isset($conteos['expirado']) ? $conteos['expirado'] : 0 ?>)
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-info">
                                <strong>Mostrando:</strong> 
                                <?php if ($filtroEstado === 'todos'): ?>
                                    Todos los canjes (<?= $cantidadCanjes ?> registros)
                                <?php else: ?>
                                    Canjes con estado "<?= ucfirst($filtroEstado) ?>" (<?= $cantidadCanjes ?> registros)
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <table id="example3" class="table table-striped table-borderless table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="text-align: center;">#</th>
                                        <th style="text-align: center;">Cliente</th>
                                        <th style="text-align: center;">Nombre de la promoción</th>
                                        <th style="text-align: center;">Puntos utilizados</th>
                                        <th style="text-align: center;">Fecha de canje</th>
                                        <th style="text-align: center;">Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($canjes)): ?>
                                        <tr>
                                            <td colspan="6" class="text-center">
                                                <em>No hay registros que mostrar para el filtro seleccionado.</em>
                                            </td>
                                        </tr>
                                    <?php else: ?>
                                        <?php $i = 1;
                                        foreach ($canjes as $row): ?>
                                            <tr>
                                                <td style="text-align: center;"><?= $i++ ?></td>
                                                <td style="text-align: center;"><?= htmlspecialchars($row['cliente']) ?></td>
                                                <td style="text-align: center;"><?= htmlspecialchars($row['promocion']) ?></td>
                                                <td style="text-align: center;"><?= $row['puntos_utilizados'] ?></td>
                                                <td style="text-align: center;"><?= date('d/m/Y H:i', strtotime($row['fyh_canje'])) ?></td>
                                                <td style="text-align: center;">
                                                    <span class="badge bg-<?= $row['estado'] === 'usado' ? 'success' : ($row['estado'] === 'expirado' ? 'danger' : 'secondary') ?>">
                                                        <?= ucfirst($row['estado']) ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal canjear puntos -->
<div class="modal fade" id="modalCanjearPuntos" tabindex="-1" aria-labelledby="modalCanjearPuntosLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCanjearPuntosLabel">Canjear Puntos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="../../app/controllers/promociones/validar_codigo.php">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="codigoCanje" class="form-label">Código de Canje</label>
                        <input type="text" class="form-control" id="codigoCanje" name="codigoCanje" maxlength="6" required pattern="\d*" title="Solo se permiten números">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Canjear</button>
                </div>
            </form>
        </div>
    </div>
</div>
 
<?php
include('../usuarios/layout/parte2.php');
?>
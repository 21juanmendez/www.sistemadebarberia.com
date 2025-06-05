<?php
include('layout/parte1.php');
?>
<style>
    :root {
        --primary-color: #2c3e50;
        --secondary-color: #e67e22;
        --accent-color: #f39c12;
    }

    body {
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .points-header {
        background: linear-gradient(135deg, var(--primary-color), #34495e);
        color: white;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .points-badge {
        background: var(--accent-color);
        color: white;
        font-size: 2rem;
        font-weight: bold;
        border-radius: 50px;
        padding: 15px 25px;
        box-shadow: 0 4px 15px rgba(243, 156, 18, 0.3);
    }

    .promo-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        overflow: hidden;
        background: white;
    }

    .promo-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    }

    .promo-header {
        background: linear-gradient(135deg, var(--secondary-color), var(--accent-color));
        color: white;
        padding: 20px;
        text-align: center;
    }

    .promo-icon {
        font-size: 3rem;
        margin-bottom: 10px;
    }

    .points-required {
        background: #e74c3c;
        color: white;
        border-radius: 25px;
        padding: 8px 15px;
        font-weight: bold;
        display: inline-block;
        margin: 10px 0;
    }

    .btn-canjear {
        background: linear-gradient(135deg, #27ae60, #2ecc71);
        border: none;
        border-radius: 25px;
        padding: 12px 30px;
        font-weight: bold;
        color: white;
        transition: all 0.3s ease;
    }

    .btn-canjear:hover {
        background: linear-gradient(135deg, #229954, #27ae60);
        transform: scale(1.05);
        color: white;
    }

    .btn-canjear:disabled {
        background: #95a5a6 !important;
        cursor: not-allowed !important;
        transform: none !important;
        color: white !important;
    }

    .btn-canjear:disabled:hover {
        background: #95a5a6 !important;
        transform: none !important;
    }

    .insufficient-points {
        opacity: 0.6;
    }

    .section-title {
        color: black;
        text-align: center;
        margin-bottom: 30px;
        font-weight: bold;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .client-info {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        padding: 15px;
        backdrop-filter: blur(10px);
    }
</style>

<div class="container py-4">
    <!-- Header con información del cliente -->
    <div class="points-header p-4 mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="client-info">
                    <h2 class="mb-2"><i class="fas fa-user-circle me-2"></i>¡Hola, <?php echo $_SESSION['cliente'] ?> !</h2>
                    <p class="mb-0"><i class="fas fa-calendar me-2"></i>Miembro desde: <?php echo $_SESSION['fecha_registro'] ?></p>
                    <p class="mb-0"><i class="fas fa-cut me-2"></i>Última visita a la barberia: <?php echo $_SESSION['ultima_visita'] ?></p>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="points-badge">
                    <i class="fas fa-coins me-2"></i>
                    <span id="userPoints"><?php echo $_SESSION['puntos'] ?></span> pts
                </div>
                <p class="mt-2 mb-0">Puntos Disponibles</p>
            </div>
        </div>
    </div>
    <!-- Título de promociones -->
    <h1 class="section-title">
        <i class="bi-gift me-2"></i>
        Promociones Disponibles
    </h1>

    <!-- Grid de promociones -->
    <div class="row g-4">
        <?php foreach ($promociones as $promo): ?>
            <?php 
                $puntosUsuario = $_SESSION['puntos'];
                $puntosRequeridos = $promo['puntos_requeridos'];
                $suficientesPuntos = $puntosUsuario >= $puntosRequeridos;
            ?>
            <div class="col-lg-4 col-md-6">
                <div class="card promo-card h-100 <?php echo !$suficientesPuntos ? 'insufficient-points' : ''; ?>">
                    <div class="promo-header p-3">
                        <i class="fas fa-gift promo-icon"></i>
                        <h4><?= htmlspecialchars($promo['nombre']) ?></h4>
                    </div>
                    <div class="card-body text-center">
                        <img src="public/imagenes/promociones/<?= htmlspecialchars($promo['imagen']) ?>" class="card-img-top" alt="Imagen de <?= htmlspecialchars($promo['nombre']) ?>" style="object-fit: cover; height: 200px;">
                        <div class="points-required"><?= htmlspecialchars($promo['puntos_requeridos']) ?> puntos</div>
                        <p class="card-text"><?= htmlspecialchars($promo['descripcion']) ?></p>
                        <?php if (!empty($promo['servicios'])): ?>
                            <ul class="list-unstyled text-start">
                                <?php foreach ($promo['servicios'] as $servicio): ?>
                                    <li>
                                        <i class="bi-check-circle text-success me-2"></i>
                                        <?= htmlspecialchars($servicio['nombre_servicio']) ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        
                        <?php if ($suficientesPuntos): ?>
                            <button class="btn btn-canjear w-100 mt-3" onclick="canjearPromocion('<?= addslashes($promo['nombre']) ?>', <?= $promo['puntos_requeridos'] ?>)">
                                <i class="fas fa-exchange-alt me-2"></i>Canjear Ahora
                            </button>
                        <?php else: ?>
                            <button class="btn btn-canjear w-100 mt-3" disabled>
                                <i class="fas fa-lock me-2"></i>Puntos Insuficientes
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Footer con información adicional -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card" style="background: rgba(255,255,255,0.9); border-radius: 15px;">
                <div class="card-body text-center">
                    <h5><i class="fas fa-info-circle me-2"></i>¿Cómo ganar más puntos?</h5>
                    <p class="text-muted">Por cada compra de un servicio que realices en nuestra barbería, acumulas puntos que puedes canjear por promociones exclusivas.</p>
                    <div class="row">
                        <?php foreach ($serviciosPuntos as $servicio): ?>
                            <div class="col-md-3 mb-3 text-center">
                                <i class="bi-check-circle text-success mb-2" style="font-size: 1.5rem;"></i>
                                <p>
                                    <strong><?= htmlspecialchars($servicio['nombre_servicio']) ?>:</strong><br>
                                    <?= intval($servicio['acumula_puntos']) ?> puntos
                                </p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmación -->
<div class="modal fade" id="confirmModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-check-circle text-success me-2"></i>Confirmar Canje</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <p>¿Estás seguro de que quieres canjear:</p>
                <h4 id="modalPromoName" class="text-primary"></h4>
                <p>Por <strong id="modalPoints"></strong> puntos?</p>
                <p class="text-muted">Puntos restantes: <span id="modalRemainingPoints"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" onclick="confirmarCanje()">
                    <i class="fas fa-check me-2"></i>Confirmar Canje
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de éxito -->
<div class="modal fade" id="successModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title"><i class="fas fa-trophy me-2"></i>¡Canje Exitoso!</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <i class="fas fa-check-circle fa-4x text-success mb-3"></i>
                <h4>¡Felicidades!</h4>
                <p>Has canjeado exitosamente: <strong id="successPromoName"></strong></p>
                <p>Código de canje: <strong class="text-primary" id="canjeCode"></strong></p>
                <p class="text-muted">Presenta este código en tu próxima visita</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success w-100" data-bs-dismiss="modal">
                    <i class="fas fa-thumbs-up me-2"></i>¡Genial!
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    let userPoints = <?php echo $_SESSION['puntos']; ?>;
    let currentPromo = {};

    function canjearPromocion(nombre, puntos) {
        if (userPoints >= puntos) {
            currentPromo = {
                nombre,
                puntos
            };
            document.getElementById('modalPromoName').textContent = nombre;
            document.getElementById('modalPoints').textContent = puntos;
            document.getElementById('modalRemainingPoints').textContent = userPoints - puntos;

            const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
            modal.show();
        } else {
            alert('No tienes suficientes puntos para esta promoción.');
        }
    }

    function confirmarCanje() {
        const confirmModal = bootstrap.Modal.getInstance(document.getElementById('confirmModal'));
        confirmModal.hide();

        fetch('<?php echo $URL ?>/app/controllers/promociones/canjear_promocion.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                nombre_promocion: currentPromo.nombre,
                puntos_requeridos: currentPromo.puntos
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Actualiza puntos
                userPoints -= currentPromo.puntos;
                document.getElementById('userPoints').textContent = userPoints;

                // Muestra los datos del canje
                document.getElementById('successPromoName').textContent = currentPromo.nombre;
                document.getElementById('canjeCode').textContent = data.codigo;

                const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();
                setTimeout(() => location.reload(), 1000);
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error en la solicitud AJAX:', error);
            alert('Error al procesar el canje.');
        });
    }

</script>

<?php
include('layout/parte2.php');
?>
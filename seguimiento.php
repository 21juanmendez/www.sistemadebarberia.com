<!-- CitasView.php -->
<?php include('layout/parte1.php'); 
include('app/controllers/citas/controller_seguimiento.php');
?>

<div style='margin: 20px; padding: 20px; border-radius: 8px; background-color: #f8f9fa;'>
    <h2 style='text-align: center; color: #004085;'>Mis Citas</h2>
    <p style='text-align: center; color: #004085;'>Aquí podrás ver todas las citas que has registrado en nuestro sistema. Puedes revisar los detalles de cada cita y su estado.</p>

    <?php if (count($citas) > 0): ?>
        <table style='width: 100%; text-align: center; border-collapse: collapse; background-color: #d1ecf1; border-radius: 5px; overflow: hidden;'>
            <tr style='background-color: #17a2b8; color: white;'>
                <th style='padding: 10px;'>Servicio</th>
                <th style='padding: 10px;'>Fecha</th>
                <th style='padding: 10px;'>Hora</th>
                <th style='padding: 10px;'>Estado</th>
                <th style='padding: 10px;'>Acciones</th>
            </tr>
            <?php foreach ($citas as $cita): ?>
                <tr style='background-color: #eaf7fa;'>
                    <td style='padding: 10px; border-bottom: 1px solid #dee2e6;'><?= htmlspecialchars($cita['nombre_servicio']) ?></td>
                    <td style='padding: 10px; border-bottom: 1px solid #dee2e6;'><?= htmlspecialchars($cita['fecha_cita']) ?></td>
                    <td style='padding: 10px; border-bottom: 1px solid #dee2e6;'><?= htmlspecialchars($cita['hora_cita']) ?></td>
                    <td style='padding: 10px; border-bottom: 1px solid #dee2e6;'><span style='background-color: #28a745; color: white; padding: 5px 10px; border-radius: 4px;'>Agendada</span></td>
                    <td style='padding: 10px; border-bottom: 1px solid #dee2e6;'>
                        <button style="color: white;" class="btn btn-info" onclick="mostrarDetalles('<?= htmlspecialchars($cita['nombre_servicio']) ?>', '<?= htmlspecialchars($cita['fecha_cita']) ?>', '<?= htmlspecialchars($cita['hora_cita']) ?>')">Ver Detalles</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <div style="padding: 20px; background-color: #fff3cd; border-radius: 5px; text-align: center; color: #856404; margin-top: 15px;">
            No tienes citas registradas.
        </div>
        <div style="text-align: center; margin-top: 20px;">
            <p style="color: #004085;">¿No tienes ninguna cita? ¡Agenda una ahora!</p>
            <a href="registrar_cita.php" style="background-color: #17a2b8; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">Reservar cita</a>
        </div>
    <?php endif; ?>
</div>

<!-- Script de SweetAlert2 para mostrar los detalles -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function mostrarDetalles(servicio, fecha, hora) {
        Swal.fire({
            icon: 'info',
            title: 'Detalles de la Cita',
            html: `
                <div style="text-align: center;">
                    <p><b>Servicio:</b> ${servicio}</p>
                    <p><b>Fecha:</b> ${fecha}</p>
                    <p><b>Hora:</b> ${hora}</p>
                    <p><b>Estado:</b> En proceso</p>
                </div>
            `,
            confirmButtonText: 'Cerrar',
            confirmButtonColor: '#17a2b8',
            width: 400,
            padding: '1.5em',
            background: '#f8f9fa',
            color: '#333'
        });
    }
</script>

<?php include('layout/parte2.php'); ?>

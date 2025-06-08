<?php
if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    $tipo = isset($_SESSION['tipo_mensaje']) ? $_SESSION['tipo_mensaje'] : 'info';
    
    // Determinar el tipo de alerta de SweetAlert2
    $swal_type = '';
    switch ($tipo) {
        case 'success':
            $swal_type = 'success';
            break;
        case 'error':
            $swal_type = 'error';
            break;
        case 'warning':
            $swal_type = 'warning';
            break;
        default:
            $swal_type = 'info';
            break;
    }
    
    echo "
    <script>
        Swal.fire({
            title: '" . ($tipo == 'success' ? '¡Éxito!' : ($tipo == 'error' ? '¡Error!' : '¡Información!')) . "',
            text: '$mensaje',
            icon: '$swal_type',
            confirmButtonText: 'Aceptar'
        });
    </script>
    ";
    
    // Limpiar las variables de sesión
    unset($_SESSION['mensaje']);
    unset($_SESSION['tipo_mensaje']);
}
?>
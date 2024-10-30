<?php
// Include the main TCPDF library (search for installation path).
include('../../app/TCPDF/tcpdf.php');
include('../../app/config.php');
include('../../app/controllers/ventas/controller_factura.php');

require '../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Crear nueva instancia de TCPDF
$pdf = new TCPDF('P', 'mm', 'LETTER', true, 'UTF-8', false);

// Establecer información del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('José Oved Chávez Vásquez');
$pdf->SetTitle('Factura_' . $id_venta);
$pdf->SetSubject('Factura de venta');
$pdf->SetKeywords('Factura, PDF, venta');

// Eliminar el header y footer por defecto
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Agregar página
$pdf->AddPage();

// Agregar imagen
$imagePath = $URL . "/public/imagenes/logo_area51.jpg";

$fecha = explode(' ', $fecha_venta);
$fecha_formateada = $fecha[0];
$hora_formateada = $fecha[1];
// Definir contenido HTML para la factura
$html = '
<h1 style="text-align:center;">FACTURA 00' . $id_venta . '</h1>
<table style="width: 100%; margin-top: 20px;">
    <tr>
        <td style="width: 60%;"><strong><br>Nombre de la empresa:</strong><br>AREA 51<br><br><strong>Dirección:</strong><br>Carretera Panamericana km 18, San Salvador, El Salvador</td>
        <td style="width: 40%; text-align:right;"><img src="' . $imagePath . '" style="width: 120px; height: 120px;"></td>
    </tr>
</table>
<br>
    <table>
        <tr>
            <td><strong>Nombre del vendedor:</strong><br>' . $nombre_vendedor . '</td>
            <td style="text-align:right;"><strong>NO. FACTURA:</strong> #00' . $id_venta . '<br><strong>FECHA DE EMISIÓN:</strong>
                ' . $fecha_formateada . '<br><strong>HORA:</strong>' . $hora_formateada . '</td>
        </tr>
    </table>
    <br>
    <h4>Detalle de venta de productos</h4>
    <table border="1" cellpadding="5">
        <thead>
            <tr style="background-color: #024CAA; color: #FFFFFF;">
                <th style="width: 20%"><strong>Nombre</strong></th>
                <th style="width: 35%"><strong>Descripcion</strong></th>
                <th style="width: 15%"><strong>Cantidad</strong></th>
                <th style="width: 15%"><strong>Precio</strong></th>
                <th style="width: 15%"><strong>Subtotal</strong></th>
            </tr>
        </thead>
        <tbody>';
if ($productos_vendidos) {
    foreach ($productos_vendidos as $producto) {
        $html .= '
                <tr>
                    <td style="width: 20%">' . $producto['nombre_producto'] . '</td>
                    <td style="width: 35%">' . $producto['descripcion'] . '</td>
                    <td style="width: 15%">' . $producto['cantidad'] . '</td>
                    <td style="width: 15%">$' . $producto['precio_venta'] . '</td>
                    <td style="width: 15%">$' . $producto['precio'] . '</td>
                </tr>';
    }
} else {
    $html .= '
                <tr>
                    <td colspan="5" style="text-align:center;">No se han vendido productos</td>
                </tr>';
}
$html .= '       
        </tbody>
    </table>

        <br>
    <h4>Detalle de venta de servicios</h4>
    <table border="1" cellpadding="5">
        <thead>
            <tr style="background-color: #024CAA; color: #FFFFFF;">
                <th style="width: 20%"><strong>Nombre</strong></th>
                <th style="width: 35%"><strong>Descripcion</strong></th>
                <th style="width: 15%"><strong>Cantidad</strong></th>
                <th style="width: 15%"><strong>Precio</strong></th>
                <th style="width: 15%"><strong>Subtotal</strong></th>
            </tr>
        </thead>
        <tbody>';
// Verificar si existen servicios vendidos
if ($servicios_vendidos) {
    foreach ($servicios_vendidos as $servicio) {
        $html .= '
                <tr>
                    <td style="width: 20%">' . $servicio['nombre_servicio'] . '</td>
                    <td style="width: 35%">' . $servicio['descripcion'] . '</td>
                    <td style="width: 15%">' . $servicio['cantidad'] . '</td>
                    <td style="width: 15%">$' . $servicio['precio_venta'] . '</td>
                    <td style="width: 15%">$' . $servicio['precio'] . '</td>
                </tr>';
    }
} else {
    $html .= '
                <tr>
                    <td colspan="5" style="text-align:center;">No se han vendido servicios</td>
                </tr>';
}
$html .= '       
        </tbody>
    </table>
    <br><br>
<table>
    <tr>
        <th style="text-align:right; font-size: 14px;"><strong>Subtotal de productos:    </strong> $' . $subtotal_productos . '</th>
    </tr>
    <tr>
        <td style="text-align:right; font-size: 14px;"><strong>Subtotal de servicios:    </strong> $' . $subtotal_servicios . '</td>
    </tr>
    <tr>
        <td style="text-align:right; font-size: 14px;"><strong>Total a cancelar:     </strong> $' . $total_venta . '</td>
    </tr>
    <br>
    <tr>
        <td style="text-align:right; font-size: 14px;"><strong>Total pagado:        </strong>$' . $total_pago . '</td>
    </tr>
    <tr>
        <td style="text-align:right; font-size: 14px;"><strong>Cambio:        </strong>$' . $cambio . '</td>
    </tr>
</table>

    <br>
';
// Escribir el contenido HTML antes del código de barras
$pdf->writeHTML($html, true, false, true, false, '');

// Generar el código de barras
$barcodeStyle = array(
    'position' => '',
    'align' => 'C',
    'stretch' => false,
    'fitwidth' => true,
    'cellfitalign' => '',
    'border' => false,
    'hpadding' => 'auto',
    'vpadding' => 'auto',
    'fgcolor' => array(0, 0, 0),
    'bgcolor' => false, //array(255,255,255)
    'text' => true,
    'font' => 'helvetica',
    'fontsize' => 8,
    'stretchtext' => 4
);
//hacer mas ancho el codigo de barras
$pdf->write1DBarcode($id_venta, 'C128', 94, '', '', 18, 0.4, $barcodeStyle, 'N');

// Continuar con el contenido HTML después del código de barras
$html = '
<p style="text-align:center; font-size: 14px;">GRACIAS POR SU COMPRA</p>
';

// Escribir el contenido HTML en el PDF
$pdf->writeHTML($html, true, false, true, false, '');

if (isset($_GET['email'])) {
    $email = $_GET['email'];
    $mail = new PHPMailer(true);
    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'baberiarea51@gmail.com';
        $mail->Password = 'swaaoxwhibetwykh';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Configuración del correo
        $mail->setFrom('baberiarea51@gmail.com', 'Barberia Area 51');
        $mail->addAddress($email);

        // Definir la ruta local para guardar la factura
        $localFilePath = __DIR__ . '/Factura_' . $id_venta . '.pdf';

        // Guardar la factura en la ruta local
        $pdf->Output($localFilePath, 'F');

        // Adjuntar la factura
        $mail->addAttachment($localFilePath);

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Barberia Area 51 - Facturacion';
        $mail->Body    = 'Gracias por tu compra. Adjunto encontrarás tu factura.';
        $mail->send();
        // Eliminar el archivo local después de enviar el correo
        unlink($localFilePath);
    } catch (Exception $e) {

    }
} else {
    $pdf->Output('Factura_' . $id_venta . '.pdf', 'I');
}

<?php
include('../../config.php');
$fecha_inicio = $_GET['start-date'];
$fecha_fin = $_GET['end-date'];
$formatear_fecha_inicio = date('Y-m-d', strtotime($fecha_inicio));
$formatear_fecha_fin = date('Y-m-d', strtotime($fecha_fin));
$filtro=$_GET['filter_true'];

//enviar datos a la vista por metodo get
header("Location:" . $VIEWS . "/reportes?fecha_inicio=" . $formatear_fecha_inicio . "&fecha_fin=" . $formatear_fecha_fin . "&f=" . $filtro);


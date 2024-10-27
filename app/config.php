<?php
// Nombre de la aplicación
define('APP_NAME', 'Sistema de Barberia');

// Obtiene el URI de conexión directamente desde la variable de entorno
$connectionUri = getenv('MYSQL_ADDON_URI');

// Intenta conectar con la base de datos usando PDO
try {
    $pdo = new PDO($connectionUri, null, null, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    // echo "Conexion Exitosa"; // Puedes descomentar esta línea para probar la conexión
} catch (PDOException $e) {
    // En caso de error de conexión, imprime el mensaje de error
    echo "Error de conexión a la base de datos: " . $e->getMessage();
    exit(); // Detiene la ejecución si falla la conexión
}

// Configura la zona horaria para fechas y horas
date_default_timezone_set('America/El_Salvador');
$fyh_creacion = date('Y-m-d H:i:s');
$fyh_actualizacion = date('Y-m-d H:i:s');

// URLs base para el proyecto
$URL = "http://localhost/www.sistemadebarberia.com";
$VIEWS = "http://localhost/www.sistemadebarberia.com/views";
?>


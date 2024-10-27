<?php
// Nombre de la aplicación
define('APP_NAME', 'Sistema de Barberia');

// Obtiene las credenciales de conexión desde las variables de entorno de Clever Cloud
$servidor = "mysql:dbname=" . getenv('MYSQL_ADDON_DB') . ";host=" . getenv('MYSQL_ADDON_HOST') . ";port=" . getenv('MYSQL_ADDON_PORT');
$usuario = getenv('MYSQL_ADDON_USER');
$password = getenv('MYSQL_ADDON_PASSWORD');

// Intenta conectar con la base de datos usando PDO
try {
    $pdo = new PDO($servidor, $usuario, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
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

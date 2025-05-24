<?php
define('APP_NAME', 'Sistema de Barberia');
define('SERVIDOR', 'localhost');
define('USUARIO', 'root');
define('PASSWORD', 'admin');
define('BD', 'sistemabarberia');

$servidor = "mysql:dbname=" . BD . ";host=" . SERVIDOR;

try {
    $pdo = new PDO($servidor, USUARIO, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    //echo "Conexion Exitosa";
} catch (PDOException $e) {
    print_r($e->getMessage());
    echo "Conexion Fallida";
}
//CREAMOS UNA VARIABLE PARA LA FECHA Y HORA, esta la usamos en controller_create.php
date_default_timezone_set('America/El_Salvador');
$fyh_creacion = date('Y-m-d H:i:s');
$fyh_actualizacion = date('Y-m-d H:i:s');

$URL = "http://localhost/www.sistemadebarberia.com";
$VIEWS = "http://localhost/www.sistemadebarberia.com/views";


<?php
define('APP_NAME', 'Sistema de Barberia');
define('SERVIDOR', 'sql203.infinityfree.com');
define('USUARIO', 'if0_37522554');
define('PASSWORD', '49Pf1I85kpe4og');
define('BD', 'if0_37522554_sistemabarberia');

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


<?php
define('APP_NAME', 'Sistema de Barberia');
define('SERVIDOR', 'ep-flat-recipe-a48y3zqz.us-east-1.pg.koyeb.app');
define('USUARIO', 'koyeb-adm');
define('PASSWORD', 'dFe5GXDMVfy4');
define('BD', 'koyebdb');

$servidor = "mysql:dbname=" . BD . ";host=" . SERVIDOR . ";port=3306";

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

$URL = "https://electrical-riva-universidaddeelsalvador-481770dc.koyeb.app/";
$VIEWS = "https://electrical-riva-universidaddeelsalvador-481770dc.koyeb.app/views";


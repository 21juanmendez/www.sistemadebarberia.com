<?php

$id_usuario = $_GET['id_usuario'];

/*Se usa INNER JOIN para unir la tabla tb_usuarios 
con la tabla tb_roles utilizando la condición ON u.id_rol = r.id_rol, donde id_rol 
es el campo que relaciona ambas tablas.
Se seleccionan todos los campos de la tabla tb_usuarios con u.*.
Se selecciona el nombre de la tabla tb_roles como nombre_rol.
Se filtra la consulta para obtener solo el usuario con el ID especificado en la variable $id_usuario.*/
$sql = "SELECT u.*, r.nombre AS nombre_rol 
        FROM tb_usuarios u
        INNER JOIN tb_roles r ON u.id_rol = r.id_rol 
        WHERE u.id_usuario = $id_usuario";
$query = $pdo->prepare($sql);
$query->execute();
$usuarios = $query->fetchAll(PDO::FETCH_ASSOC);


foreach ($usuarios as $usuario) {
    $nombre_completo = $usuario['nombre_completo'];
    $telefono = $usuario['telefono'];
    $email = $usuario['email'];
    $cargo = $usuario['nombre_rol'];
    $fyh_creacion = $usuario['fyh_creacion'];
    $fyh_actualizacion = $usuario['fyh_actualizacion'];
    $id_rol = $usuario['id_rol'];
}

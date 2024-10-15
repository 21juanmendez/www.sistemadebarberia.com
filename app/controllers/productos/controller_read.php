<?php
$id_producto = $_GET['id_producto'];

$sql = "SELECT p.*,nombre_completo,nombre FROM tb_productos p
INNER JOIN tb_usuarios u INNER JOIN tb_categorias c ON p.id_usuario=u.id_usuario 
AND p.id_categoria=c.id_categoria WHERE id_producto=$id_producto";

$query = $pdo->prepare($sql);
$query->execute();
$productos = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($productos as $producto) {
    $codigo = $producto['codigo'];
    $nombre_producto = $producto['nombre_producto'];
    $descripcion = $producto['descripcion'];
    $imagen = $producto['imagen'];
    $stock = $producto['stock'];
    $stock_minimo = $producto['stock_minimo'];
    $stock_maximo = $producto['stock_maximo'];
    $precio_compra = $producto['precio_compra'];
    $precio_venta = $producto['precio_venta'];
    $fecha_de_ingreso = $producto['fecha_de_ingreso'];
    $fyh_creacion = $producto['fyh_creacion'];
    $fyh_actualizacion = $producto['fyh_actualizacion'];
    $nombre_usuario = $producto['nombre_completo'];
    $categoria_nombre = $producto['nombre'];
    $id_categoria = $producto['id_categoria'];
}
?>

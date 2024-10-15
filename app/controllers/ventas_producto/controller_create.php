<?php
include '../../config.php'; // Conexión a la base de datos

    $id_venta = $_POST['id_venta'];
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];
    $editar = $_POST['editar'];
    $id_venta_producto = $_POST['id_venta_producto'];

    // Obtener el precio del producto
    $stmt = $pdo->prepare("SELECT stock, precio_venta FROM tb_productos WHERE id_producto = :id_producto");
    $stmt->bindParam(':id_producto', $id_producto);
    $stmt->execute();
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($producto && $producto['stock'] >= $cantidad) {

        $precio = $producto['precio_venta'] * $cantidad;

        if ($editar == 1) {
            $stmt = $pdo->prepare("UPDATE tb_ventas_producto SET cantidad = :cantidad, precio = :precio WHERE id_venta_producto = :id_venta_producto");
            $stmt->bindParam(':cantidad', $cantidad);
            $stmt->bindParam(':precio', $precio);
            $stmt->bindParam(':id_venta_producto', $id_venta_producto);
            $stmt->execute();
        } else {

        // Verificar si el producto ya existe en la venta
        $stmt = $pdo->prepare("SELECT cantidad FROM tb_ventas_producto WHERE id_venta = :id_venta AND id_producto = :id_producto");
        $stmt->bindParam(':id_venta', $id_venta);
        $stmt->bindParam(':id_producto', $id_producto);
        $stmt->execute();
        $venta_producto = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($venta_producto) {
            // Si el producto ya existe, actualizar la cantidad y el precio
            $nueva_cantidad = $venta_producto['cantidad'] + $cantidad;
            $nuevo_precio = $producto['precio_venta'] * $nueva_cantidad;

            $stmt = $pdo->prepare("UPDATE tb_ventas_producto SET cantidad = :cantidad, precio = :precio WHERE id_venta = :id_venta AND id_producto = :id_producto");
            $stmt->bindParam(':cantidad', $nueva_cantidad);
            $stmt->bindParam(':precio', $nuevo_precio);
            $stmt->bindParam(':id_venta', $id_venta);
            $stmt->bindParam(':id_producto', $id_producto);
            $stmt->execute();
        } else {
            // Si el producto no existe, insertar uno nuevo
            $stmt = $pdo->prepare("INSERT INTO tb_ventas_producto (id_venta, id_producto, cantidad, precio) VALUES (:id_venta, :id_producto, :cantidad, :precio)");
            $stmt->bindParam(':id_venta', $id_venta);
            $stmt->bindParam(':id_producto', $id_producto);
            $stmt->bindParam(':cantidad', $cantidad);
            $stmt->bindParam(':precio', $precio);
            $stmt->execute();
        }
    }
    $producto_actualizado = $producto['stock'] - $cantidad;
    $stmt = $pdo->prepare("UPDATE tb_productos SET stock = :stock WHERE id_producto = :id_producto");
    $stmt->bindParam(':stock', $producto_actualizado);
    $stmt->bindParam(':id_producto', $id_producto);
    $stmt->execute();
    header("Location:" . $VIEWS . "/ventas/create.php?id_venta=" . $id_venta);
} 
else {
    // Si no hay suficiente stock
    session_start();
    $_SESSION["mensaje"] = "No hay suficiente stock para el producto.";
    $_SESSION["icono"] = "error";
    header("Location:" . $VIEWS . "/ventas/create.php?id_venta=" . $id_venta);
}
?>
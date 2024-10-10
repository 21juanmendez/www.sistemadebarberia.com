<?php
include '../../config.php'; // Conexión a la base de datos
$id_venta = $_POST['id_venta'];
$id_servicio = $_POST['id_servicio'];
$cantidad = $_POST['cantidad_servicio'];
$editar = $_POST['editar'];
$id_venta_servicio = $_POST['id_venta_servicio'];

if(isset($_POST))

// Obtener el precio del servicio
$stmt = $pdo->prepare("SELECT precio FROM tb_servicios WHERE id_servicio = :id_servicio");
$stmt->bindParam(':id_servicio', $id_servicio);
$stmt->execute();
$servicio = $stmt->fetch(PDO::FETCH_ASSOC);

if ($servicio) {

    $precio = $servicio['precio'] * $cantidad;

    if ($editar == 1) {
        $stmt = $pdo->prepare("UPDATE tb_ventas_servicio SET cantidad = :cantidad, precio = :precio WHERE id_venta_servicio = :id_venta_servicio");
        $stmt->bindParam(':cantidad', $cantidad);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':id_venta_servicio', $id_venta_servicio);
        $stmt->execute();
    } else {
        // Verificar si el servicio ya existe en la venta
        $stmt = $pdo->prepare("SELECT cantidad FROM tb_ventas_servicio WHERE id_venta = :id_venta AND id_servicio = :id_servicio");
        $stmt->bindParam(':id_venta', $id_venta);
        $stmt->bindParam(':id_servicio', $id_servicio);
        $stmt->execute();
        $venta_servicio = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($venta_servicio) {
            // Si el servicio ya existe, actualizar la cantidad y el precio
            $nueva_cantidad = $venta_servicio['cantidad'] + $cantidad;
            $nuevo_precio = $servicio['precio'] * $nueva_cantidad;

            $stmt = $pdo->prepare("UPDATE tb_ventas_servicio SET cantidad = :cantidad, precio = :precio WHERE id_venta = :id_venta AND id_servicio = :id_servicio");
            $stmt->bindParam(':cantidad', $nueva_cantidad);
            $stmt->bindParam(':precio', $nuevo_precio);
            $stmt->bindParam(':id_venta', $id_venta);
            $stmt->bindParam(':id_servicio', $id_servicio);
            $stmt->execute();
        } else {
            // Si el servicio no existe, insertar uno nuevo
            $stmt = $pdo->prepare("INSERT INTO tb_ventas_servicio (id_venta, id_servicio, cantidad, precio) VALUES (:id_venta, :id_servicio, :cantidad, :precio)");
            $stmt->bindParam(':id_venta', $id_venta);
            $stmt->bindParam(':id_servicio', $id_servicio);
            $stmt->bindParam(':cantidad', $cantidad);
            $stmt->bindParam(':precio', $precio);
            $stmt->execute();
        }
    }
}
header("Location:" . $VIEWS . "/ventas/create.php?id_venta=" . $id_venta);

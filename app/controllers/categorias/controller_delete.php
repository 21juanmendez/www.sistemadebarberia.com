<?php
include('../../config.php');

try{
    $id_categoria = $_POST['id_categoria'];

    $sql = "DELETE FROM tb_categorias WHERE id_categoria='$id_categoria'";
    $query = $pdo->query($sql);
    session_start();
    $_SESSION['mensaje']='Categoria eliminada correctamente';
    $_SESSION['icono']='success';
    header('Location:'.$URL . '/views/categorias');
    exit();
}catch(PDOException $e){
    if($e->getCode() == '23000' && $e->errorInfo[1] == 1451){
        session_start();
        $_SESSION['mensaje'] = 'Error al eliminar la categoria. Existen productos asociados';
        $_SESSION['icono']= 'error';
        header('Location:' . $URL . '/views/categorias');
        exit();
    }else{
        throw $e;
    }
}

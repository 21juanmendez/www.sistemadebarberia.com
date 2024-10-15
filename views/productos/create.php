<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/productos/controller_productos.php');
include('../../app/controllers/categorias/controller_categorias.php');
//creamos un contador para que se vaya aumentando el codigo cada vez que ingresamos un nuevo producto
$contador = 1;
foreach ($productos as $producto) {
    $contador++;
}
function ceros($numero)
{
    $len = 0;
    $cantidad_ceros = 5;
    $aux = $numero;
    $pos = strlen($numero);
    $len = $cantidad_ceros - $pos;
    for ($i = 0; $i < $len; $i++) {
        $aux = "0" . $aux;
    }
    return $aux;
}

if (isset($_SESSION['admin'])) {
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        $sql = "SELECT * FROM tb_usuarios WHERE email='$email'";
        $query = $pdo->prepare($sql);
        $query->execute();
        $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($usuarios as $usuario) {
            $id_usuario = $usuario['id_usuario'];
        }
    }
}

//include('mensaje.php');
?>
<!--codigo html-->
<div class="container-fluid">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><b>CREAR NUEVO PRODUCTO</b></h3>
        </div>
        <div class="card-body">
            <form action="<?php echo $URL ?>/app/controllers/productos/controller_create.php" method="post" enctype="multipart/form-data" id="formulario">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">

                            <input name="id_usuario" type="text" class="form-control" value="<?php echo $id_usuario ?>" hidden>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Codigo</label>
                                    <input value="P-<?= ceros($contador); ?>" type="text" class="form-control" disabled>
                                    <input hidden value="P-<?= ceros($contador); ?>" type="text" name="codigo" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label>Nombre del producto</label>
                                    <input type="text" name="nombre_producto" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Fecha de ingreso</label>
                                    <input type="date" name="fecha_de_ingreso" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Descripcion</label>
                                    <textarea name="descripcion" class="form-control" rows="1"></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Categoria</label>
                                    <select name="id_categoria" id="" class="form-select" required>
                                    <option value="" disabled selected>Seleccione una categoría</option>
                                        <?php
                                        foreach ($lista_categorias as $categoria) {
                                        ?>
                                            <option value="<?php echo $categoria['id_categoria'] ?>"><?php echo $categoria['nombre'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Stock</label>
                                    <input type="number" name="stock" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Stock minimo</label>
                                    <input type="number" name="stock_minimo" id="stock_minimo" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Stock maximo</label>
                                    <input type="number" name="stock_maximo" id="stock_maximo" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Precio de compra</label>
                                    <input type="number" name="precio_compra" id="precio_compra" class="form-control" step="0.01" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Precio de venta</label>
                                    <input type="number" name="precio_venta" id="precio_venta" class="form-control" step="0.01" required>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Seleccione la imagen del producto</label>
                            <input name="file" class="form-control" type="file" id="file" multiple>
                            <center>
                                <output id="list">

                                </output>
                            </center>
                        </div>
                    </div>

                </div>
                <center>
                    <button class="btn btn-primary" type="submit">Registrar</button>
                    <a href="<?php echo $VIEWS ?>/productos" class="btn btn-secondary">Cancelar</a>
                </center>

            </form>
            <script>
                document.addEventListener('DOMContentLoaded', (event) => {
                    const form = document.getElementById('formulario');
                    form.addEventListener('submit', function(e) {
                        const stock_minimo = document.getElementById('stock_minimo').value;
                        const stock_maximo = document.getElementById('stock_maximo').value;
                        const precio_compra = document.getElementById('precio_compra').value;
                        const precio_venta = document.getElementById('precio_venta').value;

                        let showAlert = false;
                        let alertMessage = '';

                        // Validación de stock mínimo y máximo
                        if (parseInt(stock_minimo) > parseInt(stock_maximo)) {
                            showAlert = true;
                            alertMessage = ' El stock mínimo no puede ser mayor que el stock máximo.';
                            const stock_minimo_input = document.getElementById('stock_minimo');
                            stock_minimo_input.setAttribute('data-toggle', 'tooltip');
                            stock_minimo_input.setAttribute('data-placement', 'top');
                            stock_minimo_input.setAttribute('title', '<i class="bi bi-exclamation-triangle-fill"></i> '+alertMessage);
                            $(stock_minimo_input).tooltip({ html: true }).tooltip('show');
                            setTimeout(() => {
                                $(stock_minimo_input).tooltip('dispose');
                            }, 3000);
                        }

                        // Validación de precio de compra y precio de venta
                        if (parseFloat(precio_compra) > parseFloat(precio_venta)) {
                            showAlert = true;
                            alertMessage = ' El precio de compra no puede ser mayor que el precio de venta.';
                            const precio_compra_input = document.getElementById('precio_compra');
                            precio_compra_input.setAttribute('data-toggle', 'tooltip');
                            precio_compra_input.setAttribute('data-placement', 'top');
                            precio_compra_input.setAttribute('title', '<i class="bi bi-exclamation-triangle-fill"></i> '+ alertMessage);
                            $(precio_compra_input).tooltip({ html: true }).tooltip('show');
                            setTimeout(() => {
                                $(precio_compra_input).tooltip('dispose');
                            }, 3000);
                        }

                        if (showAlert) {
                            e.preventDefault(); // Evita que el formulario se envíe
                        }
                    });
                });
            </script>
        </div>
    </div>
</div>
<?php
include('../usuarios/layout/parte2.php');
?>
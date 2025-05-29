<?php
include('layout/parte1.php');
?>

<!--INICIO PRODUCTOS-->
<section class="our-products" id="our-products" style="background-color: #f5f5f5;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <center>
                    <br>
                    <h1 class="fw-bold">Nuestros Productos</h1>
                    <p>Explora nuestra selección de productos premium para hombres en nuestra barbería.</p>
                </center>
            </div>
        </div>

        <!-- Menú desplegable de categorías -->
        <div class="row">
            <div class="col-md-4">
                <label for="categoriaSelect">Filtrar por categoría:</label>
                <select id="categoriaSelect" onchange="filtrarProductos()" class="form-select ">
                    <option value="">Todas las categorías</option>
                    <?php
                    // Obtener todas las categorías únicas de los productos
                    $categorias = array_unique(array_column($productos, 'nombre'));
                    foreach ($categorias as $categoria) {
                        echo '<br><br>';
                        echo '<option value="' . strtolower($categoria) . '">' . $categoria . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <br>
        <!-- Lista de productos -->
        <div class="row" id="productosContainer">

            <?php
            // Variable para almacenar la categoría actual
            $categoriaActual = "";

            foreach ($productos as $producto) {
                // Obtener los datos del producto
                $nombre = $producto['nombre'];
                $descripcion = $producto['descripcion'];
                $imagen = $producto['imagen'];
                $precio_venta = $producto['precio_venta'];

                // Obtener la categoría del producto
                $categoriaProducto = $producto['nombre'];

                // Verificar si la categoría actual es diferente de la categoría del producto actual
                if ($categoriaProducto != $categoriaActual) {
                    // Si son diferentes, asignar la nueva categoría y mostrar el nombre de la categoría
                    $categoriaActual = $categoriaProducto;
                    echo '<h3>' . $categoriaActual . '</h3>';
                }
            ?>
                <div class="col-md-3 zoomP productoItem" data-categoria="<?php echo strtolower($categoriaProducto); ?>">
                    <div class="card">
                        <center>
                            <img src="<?php echo $URL ?>/public/imagenes/productos/<?php echo $imagen ?>" height="220px" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $nombre ?></h5>
                                <p class="card-text"><?php echo $descripcion ?></p>
                                <p class="card-text"><b><?php echo "Precio: $" . $precio_venta ?></b></p>
                            </div>
                        </center>
                    </div>
                    <br>
                </div>
            <?php } ?>
        </div>
        <br>
    </div>

    <script>
        // Función para filtrar productos por categoría seleccionada
        function filtrarProductos() {
            var categoriaSeleccionada = document.getElementById('categoriaSelect').value.toLowerCase(); // Convertir a minúsculas
            var items = document.getElementsByClassName('productoItem');

            // Iterar sobre los elementos y mostrar u ocultar según la categoría seleccionada
            for (var i = 0; i < items.length; i++) {
                var categoriaProducto = items[i].getAttribute('data-categoria').toLowerCase(); // Convertir a minúsculas
                if (categoriaSeleccionada === '' || categoriaProducto === categoriaSeleccionada) {
                    items[i].style.display = 'block';
                } else {
                    items[i].style.display = 'none';
                }
            }
        }
    </script>
</section>
<!--FIN PRODUCTOS-->


<?php
include('layout/parte2.php');
?>
    <!--FOOTER-->
    <footer class="container-fluid footer" >
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <center>
                        <img src="public/imagenes/logo.jpg" width="200x" height="200px">
                    </center>

                </div>
                <div class="col-md-4">
                    <h3>Información de Contacto</h3><br>
                    <p><i class="bi bi-geo-alt-fill"></i> San Salvador, El Salvador</p>
                    <p><i class="bi bi-telephone-fill"></i> +(503) 6970-4062</p>
                    <p><i class="bi bi-envelope-fill"></i> info@example.com</p>
                </div>
                <div class="col-md-4">
                    <h3>Horario de Atención</h3><br>
                    <p>Lunes a Viernes: 8:00am - 5:00pm</p>
                    <p>Sábados: 8:00am - 12:00pm</p>
                    <p>Domingos: Cerrado</p>
                </div>
            </div>
        </div>
        <center>
            <a href=""><i class="bi bi-facebook"></i>Facebook </a>
            <a href=""><i class="bi bi-twitter"></i> Twitter </a>
            <a href=""><i class="bi bi-youtube"></i> Youtube</a>
        </center>
        <br>
        <center>
            <strong>Copyright &copy; 2024 <a href="index.php">Area51</a>.</strong> Todos los derechos reservados.
        </center>
        <br>
    </footer>
    <!--FIN FOOTER-->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script>
        // Script para buscar productos por categoría
        function buscarPorCategoria(categoria) {
            // Obtener todos los productos
            var productos = <?php echo json_encode($productos); ?>;

            // Filtrar productos por categoría
            var productosFiltrados = productos.filter(function(producto) {
                return producto.nombre === categoria;
            });

            // Mostrar productos filtrados
            mostrarProductos(productosFiltrados);
        }

        // Función para mostrar productos en la página
        function mostrarProductos(productos) {
            var productosHTML = '';

            productos.forEach(function(producto) {
                productosHTML += `
            <div class="col-md-3 zoomP">
                <div class="card">
                    <center>
                        <img src="<?php echo $URL ?>/public/imagenes/productos/${producto.imagen}" height="220px" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">${producto.nombre}</h5>
                            <p class="card-text">${producto.descripcion}</p>
                            <p class="card-text"><b>Precio: $${producto.precio_venta}</b></p>
                        </div>
                    </center>
                </div>
                <br>
            </div>
        `;
            });

            // Mostrar productos en la página
            document.getElementById('productos').innerHTML = productosHTML;
        }

        // Función para buscar productos cuando se envía el formulario
        function buscarProductos() {
            var categoria = document.getElementById('categoria').value.trim();
            if (categoria !== '') {
                buscarPorCategoria(categoria);
            } else {
                // Si el campo de búsqueda está vacío, mostrar todos los productos
                mostrarTodosLosProductos();
            }
        }

        // Ejemplo de búsqueda por categoría al cargar la página
        window.onload = function() {
            // Mostrar todos los productos al cargar la página
            mostrarTodosLosProductos();
        };

        // Función para mostrar todos los productos
        function mostrarTodosLosProductos() {
            // Obtener todos los productos
            var productos = <?php echo json_encode($productos); ?>;
            // Mostrar todos los productos
            mostrarProductos(productos);
        }
    </script>
    </body>

    </html>
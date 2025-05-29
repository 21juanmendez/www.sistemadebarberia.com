<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/ventas_producto/controller_ventas_p.php');
include('../../app/controllers/ventas_servicio/controller_ventas_s.php');
include('../../app/controllers/ventas/validar.php');
include('mensaje.php');

if (isset($_GET['id_venta']) && !empty($_GET['id_venta'])) {
    $id_venta = $_GET['id_venta'];
} else {
    // Manejar el error si no existe el id_venta
    echo "ID de venta no proporcionado.";
    exit; // Detener la ejecución si el id no es válido
}
?>
<!-- Ocultar preloader -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const preloader = document.getElementById('ocultar_preloader');
        preloader.style.display = 'none';
    });
</script>
<style>
    .suggestions {
        border: 1px solid #ddd;
        max-height: 150px;
        overflow-y: auto;
        position: absolute;
        width: 95%;
        z-index: 1000;
        /* Asegurarse de que esté por encima de otros elementos */
        background-color: white;
        /* Fondo blanco para que sea visible */
    }

    .suggestion-item {
        padding: 10px;
        cursor: pointer;
    }

    .suggestion-item:hover {
        background-color: #f0f0f0;
    }
</style>
<!--codigo html-->
<div class="container-fluid">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><b>Nueva venta</b></h3>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <div class="card" style="border-radius: 10px; border: 1px solid #ddd;">
                        <div class="card-header">
                            <h3>Facturación de productos</h3>
                        </div>
                        <div class="card-body">
                            <form id="form_productos" action="<?php echo $URL ?>/app/controllers/ventas_producto/controller_create.php" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="hidden" name="id_venta" value="<?php echo $id_venta; ?>">
                                            <label>Nombre del producto</label>
                                            <input id="nombre_producto" type="text" class="form-control" autocomplete="off" required>
                                            <div id="error_prod_id" style="display: none;">
                                                <i class="bi bi-info-circle text-danger"></i>
                                                <span id="prod_id_novalidate" class="text-danger"></span>
                                            </div>
                                            <input type="hidden" id="id_producto" name="id_producto" value="0">
                                            <div id="suggestions" class="suggestions"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Cantidad</label>
                                            <input id="cantidad_producto" name="cantidad" type="number" class="form-control" value="1" required>
                                            <div id="mensaje_error_prod" style="display: none;">
                                                <i class="bi bi-info-circle text-danger"></i>
                                                <span id="mensaje_prod" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="editar" id="editar_producto" value="0">
                                    <input type="hidden" name="id_venta_producto" id="id_venta_producto" value="0">
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary" style="margin-top: 32px;">
                                            <i class="bi bi-cart3"></i> Agregar producto
                                        </button>
                                    </div>
                                </div>

                            </form>

                            <script>
                                document.addEventListener('DOMContentLoaded', (event) => {
                                    const input = document.getElementById('cantidad_producto');
                                    const mensajeError = document.getElementById('mensaje_error_prod');
                                    const mensajeTexto = document.getElementById('mensaje_prod');
                                    const form = document.getElementById('form_productos');
                                    const input_id_prod_novalidate = document.getElementById('prod_id_novalidate');
                                    const id_prod = document.getElementById('error_prod_id');

                                    input.addEventListener('input', function() {
                                        const cantidad_producto = input.value;
                                        let showAlert = false;
                                        let alertMessage = '';

                                        // Validación de cantidad de producto
                                        if (cantidad_producto <= 0) {
                                            showAlert = true;
                                            alertMessage = 'No valido';
                                        }

                                        if (showAlert) {
                                            mensajeTexto.textContent = alertMessage;
                                            mensajeError.style.display = 'block'; // Muestra el mensaje de error
                                        } else {
                                            mensajeError.style.display = 'none'; // Oculta el mensaje de error si todo está bien
                                        }
                                    });

                                    form.addEventListener('submit', function(event) {
                                        const cantidad_producto = input.value;
                                        const input_id_prod = document.getElementById('id_producto').value; // Obtener el valor actual de id_producto

                                        if (cantidad_producto <= 0 || input_id_prod == 0) {
                                            event.preventDefault(); // Evita que el formulario se envíe
                                            input_id_prod_novalidate.textContent = 'Seleccione un producto valido';
                                            id_prod.style.display = 'block';
                                        } else {
                                            id_prod.style.display = 'none';
                                        }
                                    });
                                });
                            </script>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-hover tb_ventass">
                                        <thead class="table-ligth">
                                            <tr>
                                                <th style="text-align: center;">Nombre del producto</th>
                                                <th style="text-align: center;">Cantidad</th>
                                                <th style="text-align: center;">Subtotal</th>
                                                <th style="text-align: center;">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="productos_tbody">
                                            <!-- Productos se agregarán aquí -->
                                            <?php
                                            $subtotal_productos = 0;
                                            foreach ($productos_vendidos as $productos) {

                                                if ($productos['id_venta'] == $id_venta) {
                                                    $subtotal_productos += $productos['precio'];

                                            ?>
                                                    <tr>
                                                        <td>
                                                            <center><?php echo $productos['nombre_producto'] ?></center>
                                                        </td>
                                                        <td>
                                                            <center><?php echo $productos['cantidad'] ?></center>
                                                        </td>
                                                        <td>
                                                            <center><?php echo $productos['precio'] ?></center>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-success btn-sm" onclick="editarProducto('<?php echo $productos['id_venta_producto']; ?>', '<?php echo $productos['nombre_producto']; ?>','<?php echo $productos['id_producto']; ?>', <?php echo $productos['cantidad']; ?>)"><i class="bi bi-pencil-square"></i></button>
                                                            <a href="<?php echo $URL ?>/app/controllers/ventas_producto/controller_delete.php?id_venta=<?php echo $id_venta ?>&id_venta_producto=<?php echo $productos['id_venta_producto'] ?>&id_producto=<?php echo $productos['id_producto'] ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></a>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <script>
                                        function editarProducto(id_venta_producto, nombre_producto, id_producto, cantidad) {
                                            document.getElementById('nombre_producto').value = nombre_producto;
                                            document.getElementById('nombre_producto').disabled = true;
                                            document.getElementById('id_venta_producto').value = id_venta_producto;
                                            document.getElementById('id_producto').value = id_producto;
                                            document.getElementById('cantidad_producto').value = cantidad;
                                            document.getElementById('editar_producto').value = 1;
                                        }
                                    </script>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-8" style="text-align: right;">
                                            <h5><strong>Sub total de productos</strong></h5>
                                        </div>
                                        <div class="col-md-4" style="text-align: center;">
                                            <h5 id="subtotal">$<?php echo number_format($subtotal_productos, 2) ?></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- script para buscar productos -->
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const input = document.getElementById('nombre_producto');
                        var input_id_prod = document.getElementById('id_producto');
                        const suggestions = document.querySelector('#suggestions');

                        input.addEventListener('input', function() {
                            const term = input.value;

                            if (term.length >= 1) {
                                fetch('<?php echo $URL ?>/app/controllers/productos/buscar_producto.php', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/x-www-form-urlencoded'
                                        },
                                        body: `term=${term}`
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        suggestions.innerHTML = '';
                                        data.forEach(item => {
                                            const div = document.createElement('div');
                                            div.classList.add('suggestion-item');
                                            div.textContent = `${item.id_producto} - ${item.nombre_producto}`;
                                            div.addEventListener('click', function() {
                                                input.value = item.nombre_producto;
                                                input_id_prod.value = item.id_producto;
                                                suggestions.innerHTML = '';
                                            });
                                            suggestions.appendChild(div);
                                        });
                                    });
                            } else {
                                suggestions.innerHTML = '';
                            }
                        });
                    });
                </script>


                <!-- Segunda Card - Facturación de Servicios -->
                <div class="col-md-6">
                    <div class="card" style="border-radius: 10px; border: 1px solid #ddd;">
                        <div class="card-header">
                            <h3>Facturación de servicios</h3>
                        </div>
                        <div class="card-body">
                            <form id="form_servicios" action="<?php echo $URL ?>/app/controllers/ventas_servicio/controller_create.php" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="hidden" name="id_venta" value="<?php echo $id_venta; ?>">
                                            <label>Nombre del servicio</label>
                                            <input id="nombre_servicio" name="nombre_servicio" type="text" class="form-control" autocomplete="off" required>
                                            <div id="error_serv_id" style="display: none;">
                                                <i class="bi bi-info-circle text-danger"></i>
                                                <span id="serv_id_novalidate" class="text-danger"></span>
                                            </div>
                                            <input type="hidden" id="id_servicio" name="id_servicio" value="0">
                                            <div id="suggestions_servicios" class="suggestions"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Cantidad</label>
                                            <input id="cantidad_servicio" name="cantidad_servicio" type="number" value="1" class="form-control" required>
                                            <div id="mensaje_error_serv" style="display: none;">
                                                <i class="bi bi-info-circle text-danger"></i>
                                                <span id="mensaje_serv" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="editar" id="editar_servicio" value="0">
                                    <input type="hidden" name="id_venta_servicio" id="id_venta_servicio" value="0">
                                    <div class="col-md-4">
                                        <button id="agregarServicio" type="submit" class="btn btn-primary" style="margin-top: 32px;">
                                            <i class="bi bi-scissors"></i> Agregar servicio
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <script>
                                // Guardar la posición del scroll en el localStorage, esto es para la vista movil
                                document.addEventListener('DOMContentLoaded', (event) => {
                                    const formServicios = document.getElementById('form_servicios');
                                    const scrollPosition = localStorage.getItem('scrollPosition');

                                    if (scrollPosition) {
                                        window.scrollTo(0, scrollPosition);
                                        localStorage.removeItem('scrollPosition');
                                    }

                                    formServicios.addEventListener('submit', function() {
                                        localStorage.setItem('scrollPosition', window.scrollY);
                                    });
                                });
                            </script>
                            <script>
                                // Validación de cantidad de servicio
                                document.addEventListener('DOMContentLoaded', (event) => {
                                    const input = document.getElementById('cantidad_servicio');
                                    const mensajeError = document.getElementById('mensaje_error_serv');
                                    const mensajeTexto = document.getElementById('mensaje_serv');
                                    const form = document.getElementById('form_servicios');
                                    const input_id_serv_novalidate = document.getElementById('serv_id_novalidate');
                                    const id_serv = document.getElementById('error_serv_id');

                                    input.addEventListener('input', function() {
                                        const cantidad_servicio = input.value;
                                        let showAlert = false;
                                        let alertMessage = '';

                                        // Validación de cantidad de servicio
                                        if (cantidad_servicio <= 0) {
                                            showAlert = true;
                                            alertMessage = 'No valido';
                                        }

                                        if (showAlert) {
                                            mensajeTexto.textContent = alertMessage;
                                            mensajeError.style.display = 'block'; // Muestra el mensaje de error
                                        } else {
                                            mensajeError.style.display = 'none'; // Oculta el mensaje de error si todo está bien
                                        }
                                    });

                                    form.addEventListener('submit', function(event) {
                                        const cantidad_servicio = input.value;
                                        const input_id_serv = document.getElementById('id_servicio').value; // Obtener el valor actual de id_servicio

                                        if (cantidad_servicio <= 0 || input_id_serv == 0) {
                                            event.preventDefault(); // Evita que el formulario se envíe
                                            input_id_serv_novalidate.textContent = 'Seleccione un servicio valido';
                                            id_serv.style.display = 'block';
                                        } else {
                                            id_serv.style.display = 'none';
                                        }
                                    });
                                });
                            </script>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-hover tb_ventass">
                                        <thead class="table-ligth">
                                            <tr>
                                                <th style="text-align: center;">Nombre del servicio</th>
                                                <th style="text-align: center;">Cantidad</th>
                                                <th style="text-align: center;">Subtotal</th>
                                                <th style="text-align: center;">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="servicios_tbody">
                                            <?php
                                            $subtotal_servicios = 0;
                                            $puntos_acumulados = 0;
                                            foreach ($servicios_vendidos as $servicios) {

                                                if ($servicios['id_venta'] == $id_venta) {
                                                    $subtotal_servicios += $servicios['precio'];
                                                    $puntos_acumulados += $servicios['puntos_servicio'];

                                            ?>
                                                    <tr>
                                                        <td>
                                                            <center><?php echo $servicios['nombre_servicio'] ?></center>
                                                        </td>
                                                        <td>
                                                            <center><?php echo $servicios['cantidad'] ?></center>
                                                        </td>
                                                        <td>
                                                            <center><?php echo $servicios['precio'] ?></center>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-success btn-sm" onclick="editarServicio('<?php echo $servicios['id_venta_servicio']; ?>', '<?php echo $servicios['nombre_servicio']; ?>','<?php echo $servicios['id_servicio']; ?>', <?php echo $servicios['cantidad']; ?>)"><i class="bi bi-pencil-square"></i></button>
                                                            <a href="<?php echo $URL ?>/app/controllers/ventas_servicio/controller_delete.php?id_venta=<?php echo $id_venta ?>&id_venta_servicio=<?php echo $servicios['id_venta_servicio'] ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></a>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <script>
                                        function editarServicio(id_venta_servicio, nombre_servicio, id_servicio, cantidad) {
                                            document.getElementById('nombre_servicio').value = nombre_servicio;
                                            document.getElementById('nombre_servicio').disabled = true;
                                            document.getElementById('id_venta_servicio').value = id_venta_servicio;
                                            document.getElementById('id_servicio').value = id_servicio;
                                            document.getElementById('cantidad_servicio').value = cantidad;
                                            document.getElementById('editar_servicio').value = 1;
                                        }
                                    </script>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-8" style="text-align: right;">
                                            <h5><strong>Sub total de servicios</strong></h5>
                                        </div>
                                        <div class="col-md-4" style="text-align: center;">
                                            <h5 id="subtotal_servicios">$<?php echo number_format($subtotal_servicios, 2) ?></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- script para buscar servicios -->
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const input = document.getElementById('nombre_servicio');
                        var input_id_serv = document.getElementById('id_servicio');
                        const suggestions = document.querySelector('#suggestions_servicios');

                        input.addEventListener('input', function() {
                            const term = input.value;

                            if (term.length >= 1) {
                                fetch('<?php echo $URL ?>/app/controllers/servicios/buscar_servicio.php', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/x-www-form-urlencoded'
                                        },
                                        body: `term=${term}`
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        suggestions.innerHTML = '';
                                        data.forEach(item => {
                                            const div = document.createElement('div');
                                            div.classList.add('suggestion-item');
                                            div.textContent = `${item.id_servicio} - ${item.nombre_servicio}`;
                                            div.addEventListener('click', function() {
                                                input.value = item.nombre_servicio;
                                                input_id_serv.value = item.id_servicio;
                                                suggestions.innerHTML = '';
                                            });
                                            suggestions.appendChild(div);
                                        });
                                    });
                            } else {
                                suggestions.innerHTML = '';
                            }
                        });
                    });
                </script>

            </div>
            <br>
            <form action="<?php echo $URL ?>/app/controllers/ventas/controller_create.php" method="post" id="formulario_venta">
                <!-- Modal -->
                <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content" style="width: 110%;">
                            <div class="modal-header">
                                <h5 class="modal-title" id="paymentModalLabel">Detalles de Pago</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="card" style="padding: 10px;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nombre del cliente</label>
                                                <input id="nombre_cliente" type="text" class="form-control" autocomplete="off" required disabled value="Público General">
                                                <div id="suggestions_clientes" class="suggestions"></div>
                                            </div>
                                            <input type="hidden" name="id_cliente" id="id_cliente" value="0">
                                        </div>

                                        <!-- Script para buscar cliente -->
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                const input = document.getElementById('nombre_cliente');
                                                const suggestions = document.querySelector('#suggestions_clientes');
                                                const id_cliente_input = document.getElementById('id_cliente');

                                                input.addEventListener('input', function() {
                                                    const term = input.value;

                                                    if (term.length >= 1) {
                                                        fetch('<?php echo $URL ?>/app/controllers/clientes/buscar_cliente.php', {
                                                                method: 'POST',
                                                                headers: {
                                                                    'Content-Type': 'application/x-www-form-urlencoded'
                                                                },
                                                                body: `term=${term}`
                                                            })
                                                            .then(response => response.json())
                                                            .then(data => {
                                                                console.log(data);
                                                                suggestions.innerHTML = '';
                                                                data.forEach(item => {
                                                                    const div = document.createElement('div');
                                                                    div.classList.add('suggestion-item');
                                                                    div.textContent = `${item.id_cliente} - ${item.nombre_cliente}`;
                                                                    div.addEventListener('click', function() {
                                                                        input.value = item.nombre_cliente;
                                                                        id_cliente_input.value = item.id_cliente;
                                                                        suggestions.innerHTML = '';
                                                                    });
                                                                    suggestions.appendChild(div);
                                                                });
                                                            });
                                                    } else {
                                                        suggestions.innerHTML = '';
                                                    }
                                                });
                                            });
                                        </script>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                const publicoGeneralRadio = document.getElementById('facturar_publico');
                                                const clienteRegistradoRadio = document.getElementById('facturar_cliente');
                                                const nombreClienteInput = document.getElementById('nombre_cliente');
                                                const idClienteInput = document.getElementById('id_cliente');
                                                const ocultarPuntosLbl = document.getElementById('ocultar_puntos_lbl');
                                                const ocultarPuntoTxt = document.getElementById('ocultar_puntos_txt');

                                                publicoGeneralRadio.addEventListener('change', function() {
                                                    if (publicoGeneralRadio.checked) {
                                                        nombreClienteInput.disabled = true;
                                                        nombreClienteInput.value = 'Público General';
                                                        idClienteInput.value = 0; // Resetear el ID del cliente
                                                        ocultarPuntosLbl.style.display = 'none'; // Ocultar etiqueta de puntos
                                                        ocultarPuntoTxt.style.display = 'none'; // Ocultar texto de puntos
                                                    }
                                                });

                                                clienteRegistradoRadio.addEventListener('change', function() {
                                                    if (clienteRegistradoRadio.checked) {
                                                        nombreClienteInput.disabled = false;
                                                        nombreClienteInput.value = '';
                                                        ocultarPuntoTxt.style.display = 'block'; // Mostrar texto de puntos
                                                        ocultarPuntosLbl.style.display = 'block'; // Mostrar etiqueta de puntos
                                                    }
                                                });
                                            });
                                        </script>
                                        <div class="col-md-4 ml-2">
                                            <div class="form-group">
                                                <label for="radio_facturacion">Facturar a:</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" id="facturar_publico" name="radio_facturacion" value="publico_general" required checked>
                                                        <label class="form-check-label" for="facturar_publico">Público General</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" id="facturar_cliente" name="radio_facturacion" value="cliente_registrado" required>
                                                        <label class="form-check-label" for="facturar_cliente">Cliente Registrado</label>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Subtotal de Productos (Solo Texto) -->
                                <div class="card" style="padding: 10px;">
                                    <div class="row">
                                        <div class="col-md-8" style="text-align: right;">
                                            <label for="subtotal_productos">Subtotal de Productos</label>
                                        </div>
                                        <div class="col-md-3" style="text-align: right;">
                                            <p class="form-control-plaintext">$<?php echo number_format($subtotal_productos, 2) ?></p>
                                            <input type="hidden" name="subtotal_productos" value="<?php echo number_format($subtotal_productos, 2) ?>">
                                        </div>
                                    </div>

                                    <!-- Subtotal de Servicios (Solo Texto) -->
                                    <div class="row">
                                        <div class="col-md-8" style="text-align: right;">
                                            <label for="subtotal_servicios">Subtotal de Servicios</label>
                                        </div>
                                        <div class="col-md-3" style="text-align: right;">
                                            <p class="form-control-plaintext">$<?php echo number_format($subtotal_servicios, 2) ?></p>
                                            <input type="hidden" name="subtotal_servicios" value="<?php echo number_format($subtotal_servicios, 2) ?>">
                                        </div>
                                    </div>
                                    <input type="hidden" name="id_venta" value="<?php echo $id_venta; ?>">
                                    <!-- Total a Pagar (Solo Texto) -->
                                    <div class="row">
                                        <div class="col-md-8" style="text-align: right;">
                                            <label for="total_a_pagar">Total a Pagar</label>
                                        </div>
                                        <div class="col-md-3" style="text-align: right;">
                                            <p class="form-control-plaintext text-success">$<?php echo number_format($subtotal_productos + $subtotal_servicios, 2) ?></p>
                                            <input type="hidden" id="total_a_pagar_hidden" name="total_a_pagar" value="<?php echo number_format($subtotal_productos + $subtotal_servicios, 2) ?>">
                                        </div>
                                    </div>

                                    <!-- Puntos acumulados (Solo Texto) -->
                                    <div class="row">
                                        <div class="col-md-8" style="text-align: right; display: none;" id="ocultar_puntos_lbl">
                                            <label for="puntos_acumulados">Puntos acumulados</label>
                                        </div>
                                        <div class="col-md-3" style="text-align: right; display: none;" id="ocultar_puntos_txt">
                                            <p class="form-control-plaintext text-success"><?php echo $puntos_acumulados ?></p>
                                        </div>
                                        <input type="hidden" id="puntos_acumulados_hidden" name="puntos_acumulados" value="<?php echo $puntos_acumulados ?>">
                                    </div>

                                    <div>
                                        <div class="col-md-11" style="text-align: right;">
                                            <div id="mensaje_error" style="display: none;">
                                                <i class="bi bi-info-circle text-danger"></i>
                                                <span id="mensaje_texto" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="card" style="padding: 10px;">
                                    <br>
                                    <!-- Total Pagado (Editable) -->
                                    <div class="row">
                                        <div class="col-md-8" style="text-align: right;">
                                            <label for="total_pagado">Total Pagado</label>
                                        </div>
                                        <div class="col-md-3" style="text-align: right;">
                                            <div class="form-group">
                                                <input type="number" class="form-control" id="total_pagado" name="total_pagado" required>
                                                <div id="error_pago" style="display: none;">
                                                    <i class="bi bi-info-circle text-danger"></i>
                                                    <span id="mensaje_texto_pago" class="text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cambio (Editable) -->
                                    <div class="row">
                                        <div class="col-md-8" style="text-align: right;">
                                            <label for="cambio">Cambio</label>
                                        </div>
                                        <div class="col-md-3" style="text-align: right;">
                                            <p class="form-control-plaintext" id="cambio">$0.00</p>
                                            <input type="hidden" id="cambio_hidden" name="cambio">
                                        </div>
                                    </div>
                                </div>
                                <!-- Imprimir Factura -->
                                <div class="row align-items-center">
                                    <div class="col-10 col-md-10 text-right d-flex align-items-center justify-content-end">
                                        <label for="imprimir_factura">Imprimir Factura</label>
                                    </div>
                                    <div class="col-2 col-md-2 text-center d-flex align-items-center justify-content-center">
                                        <div class="form-group mb-0">
                                            <input type="checkbox" id="imprimir_factura" name="imprimir_factura" value="1">
                                        </div>
                                    </div>
                                </div>
                                <!-- Enviar factura a correo electronico -->
                                <div class="row align-items-center">
                                    <div class="col-10 col-md-10 text-right d-flex align-items-center justify-content-end">
                                        <label for="enviar_factura">Enviar factura a correo</label>
                                    </div>
                                    <div class="col-2 col-md-2 text-center d-flex align-items-center justify-content-center">
                                        <div class="form-group mb-0">
                                            <input type="checkbox" id="enviar_factura" name="enviar_factura" value="1" onchange="toggleEmailInput()">
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="email_input_container" style="display: none;">
                                        <label for="email_factura">Correo Electrónico</label>
                                        <input type="email" id="email_factura" name="email_factura" class="form-control">
                                        <div id="error_email" style="display: none;">
                                            <i class="bi bi-info-circle text-danger"></i>
                                            <span id="mensaje_texto_email" class="text-danger"></span>
                                        </div>
                                    </div>

                                    <script>
                                        function toggleEmailInput() {
                                            const emailInputContainer = document.getElementById('email_input_container');
                                            const enviarFacturaCheckbox = document.getElementById('enviar_factura');
                                            if (enviarFacturaCheckbox.checked) {
                                                emailInputContainer.style.display = 'block';
                                            } else {
                                                emailInputContainer.style.display = 'none';
                                            }
                                        }
                                    </script>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    Cancelar venta
                                </button>
                                <button type="submit" class="btn btn-success">Finalizar venta</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <script>
                document.addEventListener('DOMContentLoaded', (event) => {
                    const form = document.getElementById('formulario_venta');
                    const input = document.getElementById('total_pagado');
                    const pago_mensajeError = document.getElementById('error_pago');
                    const pago_mensajeTexto = document.getElementById('mensaje_texto_pago');
                    const mensajeError = document.getElementById('mensaje_error');
                    const mensajeTexto = document.getElementById('mensaje_texto');
                    const cambio = document.getElementById('cambio');
                    const cambio_hidden = document.getElementById('cambio_hidden');
                    const erroremail = document.getElementById('error_email');
                    const email_mensajeTexto = document.getElementById('mensaje_texto_email');

                    input.addEventListener('input', function() {
                        const total_pagado = input.value;
                        const total_a_pagar = <?php echo $subtotal_productos + $subtotal_servicios; ?>;
                        let showAlert = false;
                        let alertMessage = '';

                        // Validación de pago
                        if (total_pagado < total_a_pagar && total_pagado > 0) {
                            showAlert = true;
                            alertMessage = 'Pago insuficiente';
                        } else {
                            if (total_pagado <= 0) {
                                showAlert = true;
                                alertMessage = 'No valido';
                                cambio.textContent = '$0.00';
                            } else {
                                cambio.textContent = `$${(total_pagado - total_a_pagar).toFixed(2)}`;
                                cambio_hidden.value = (total_pagado - total_a_pagar).toFixed(2);
                            }
                        }


                        if (showAlert) {
                            pago_mensajeTexto.textContent = alertMessage;
                            pago_mensajeError.style.display = 'block'; // Muestra el mensaje de error
                        } else {
                            pago_mensajeError.style.display = 'none'; // Oculta el mensaje de error si todo está bien
                        }
                    });

                    form.addEventListener('submit', function(event) {
                        const total_pagado = input.value;
                        const total_a_pagar = <?php echo $subtotal_productos + $subtotal_servicios; ?>;
                        const imprimir_factura = document.getElementById('imprimir_factura').checked;
                        const enviar_factura = document.getElementById('enviar_factura').checked;
                        const email_factura = document.getElementById('email_factura').value;

                        if (total_pagado < total_a_pagar) {
                            event.preventDefault(); // Evita que el formulario se envíe
                        } else {
                            if (total_a_pagar == 0) {
                                event.preventDefault(); // Evita que el formulario se envíe
                                mensajeTexto.textContent = 'La venta esta vacia';
                                mensajeError.style.display = 'block';
                            } else {
                                mensajeError.style.display = 'none';

                                if (enviar_factura == true && email_factura == '') {
                                    event.preventDefault(); // Evita que el formulario se envíe
                                    erroremail.style.display = 'block';
                                    email_mensajeTexto.textContent = 'Ingrese un correo electronico valido';
                                } else {
                                    erroremail.style.display = 'none';
                                    //enviar factura a correo
                                    if (enviar_factura == true) {
                                        fetch(`<?php echo $VIEWS ?>/ventas/factura.php?id_venta=<?php echo $id_venta ?>&email=${email_factura}`, {
                                            method: 'GET'
                                        });
                                    }
                                    if (imprimir_factura == true) {
                                        //rediriir a la pagina de impresion en nueva pestaña
                                        window.open('<?php echo $VIEWS ?>/ventas/factura.php?id_venta=<?php echo $id_venta ?>', '_blank');
                                    }
                                }
                            }
                        }
                    });


                });
            </script>

            <center>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#paymentModal">
                    Procesar Pago
                </button>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Cancelar venta
                </button>

            </center>



            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content modal-centered">
                        <div class="modal-header" style="background-color: red;">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel"><b>Cancelar Venta<b></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>¿Esta seguro de que desea cancelar esta venta?</p>
                        </div>
                        <div class="modal-footer">
                            <center>
                                <a class="btn btn-danger" href="<?php echo $URL ?>/app/controllers/ventas/controller_cancelar.php?id_venta=<?php echo $id_venta ?>" class="btn btn-secondary">Aceptar</a>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<?php
include('../usuarios/layout/parte2.php');

?>
<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/compras/controller_compras.php');
include('../../app/controllers/proveedores/controller_proveedores.php');
include('../../app/controllers/productos/controller_productos.php');
include('mensaje.php');
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><b>LISTADO DE COMPRAS</b></h3>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-end flex-wrap mt-3 mb-3 gap-3">

                        <!-- Botón a la izquierda -->
                        <div class="align-self-center">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalRegistrarCompra">
                                <i class="bi bi-plus-lg"></i> Registrar nueva compra
                            </button>
                        </div>

                        <!-- Filtros a la derecha -->
                        <div class="d-flex flex-wrap gap-3 justify-content-end">

                            <div class="d-flex align-items-center">
                                <span id="contadorResultados" class="text-muted me-2"></span>
                            </div>

                            <div class="form-group">
                                <label for="filtroEstado">Estado:</label>
                                <select id="filtroEstado" class="form-control">
                                    <option value="">Todos</option>
                                    <option value="pendiente">Pendiente</option>
                                    <option value="en curso">En Curso</option>
                                    <option value="completada">Completada</option>
                                    <option value="cancelada">Cancelada</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="filtroProveedor">Proveedor:</label>
                                <select id="filtroProveedor" class="form-control">
                                    <option value="">Todos</option>
                                    <?php foreach ($proveedores as $proveedor) { ?>
                                        <option value="<?php echo $proveedor['nombre_empresa'] ?>"><?php echo $proveedor['nombre_empresa'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group align-self-end">
                                <button type="button" class="btn btn-info" onclick="limpiarFiltros()">
                                    <i class="bi bi-x-circle me-1"></i> Limpiar filtros
                                </button>
                            </div>

                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-12">
                            <table id="tb_compras" class="table table-striped table-borderless table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="text-align: center;">#</th>
                                        <th style="text-align: center;">Fecha</th>
                                        <th style="text-align: center;">Proveedor</th>
                                        <th style="text-align: center;">Usuario</th>
                                        <th style="text-align: center;">Total</th>
                                        <th style="text-align: center;">Estado</th>
                                        <th style="text-align: center;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tablaComprasBody">
                                    <?php
                                    $contador = 0;
                                    foreach ($compras as $compra) {
                                        $contador++;
                                        // Determinar clase de estado
                                        $badge_class = '';
                                        switch ($compra['estado']) {
                                            case 'pendiente':
                                                $badge_class = 'bg-warning';
                                                break;
                                            case 'en curso':
                                                $badge_class = 'bg-info';
                                                break;
                                            case 'completada':
                                                $badge_class = 'bg-success';
                                                break;
                                            case 'cancelada':
                                                $badge_class = 'bg-danger';
                                                break;
                                        }
                                    ?>
                                        <tr class="fila-compra"
                                            data-estado="<?php echo $compra['estado'] ?>"
                                            data-fecha="<?php echo $compra['fecha_compra'] ?>"
                                            data-proveedor="<?php echo $compra['nombre_empresa'] ?>">
                                            <td>
                                                <center><?php echo $contador ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo date('d/m/Y', strtotime($compra['fecha_compra'])) ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $compra['nombre_empresa'] ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $compra['nombre_completo'] ?></center>
                                            </td>
                                            <td>
                                                <center>$<?php echo number_format($compra['total_compra'], 2) ?></center>
                                            </td>
                                            <td>
                                                <center><span class="badge <?php echo $badge_class ?> p-2"><?php echo ucfirst($compra['estado']) ?></span></center>
                                            </td>
                                            <td>
                                                <center>
                                                    <button type="button" class="btn btn-info btn-sm" onclick="verDetalleCompra(<?php echo $compra['id_compra'] ?>)">
                                                        <i class="bi bi-eye-fill"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-success btn-sm" onclick="editarCompra(<?php echo $compra['id_compra'] ?>)" <?php echo $compra['estado'] != 'pendiente' ? 'disabled' : '' ?>>
                                                        <i class="bi bi-pencil-square"></i>
                                                        Cambiar Estado
                                                    </button>
                                                </center>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Registrar Compra -->
<div class="modal fade" id="modalRegistrarCompra" tabindex="-1" aria-labelledby="modalRegistrarCompraLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalRegistrarCompraLabel">
                    <i class="bi bi-plus-circle"></i> Registrar Nueva Compra
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formRegistrarCompra" action="../../app/controllers/compras/controller_create.php" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="id_proveedor">Proveedor <span class="text-danger">*</span></label>
                                <select name="id_proveedor" id="id_proveedor" class="form-control" required>
                                    <option value="">Seleccione un proveedor</option>
                                    <?php foreach ($proveedores as $proveedor) { ?>
                                        <option value="<?php echo $proveedor['id_proveedor'] ?>"><?php echo $proveedor['nombre_empresa'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="fecha_compra">Fecha de Compra <span class="text-danger">*</span></label>
                                <input type="date" name="fecha_compra" id="fecha_compra" class="form-control" value="<?php echo date('Y-m-d') ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h5>Productos</h5>
                            <button type="button" class="btn btn-success btn-sm mb-3" onclick="agregarProducto()">
                                <i class="bi bi-plus"></i> Agregar Producto
                            </button>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tablaProductos">
                                    <thead class="table-secondary">
                                        <tr>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Precio Unitario</th>
                                            <th>Subtotal</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodyProductos">
                                        <!-- Los productos se agregan dinámicamente -->
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-end">Total:</th>
                                            <th><span id="totalCompra">$0.00</span></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Registrar Compra</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Ver Detalle -->
<div class="modal fade" id="modalVerDetalle" tabindex="-1" aria-labelledby="modalVerDetalleLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="modalVerDetalleLabel">
                    <i class="bi bi-eye"></i> Detalle de Compra
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="contenidoDetalle">
                <!-- El contenido se carga dinámicamente -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Compra -->
<div class="modal fade" id="modalEditarCompra" tabindex="-1" aria-labelledby="modalEditarCompraLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="modalEditarCompraLabel">
                    <i class="bi bi-pencil-square"></i> Editar Compra
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="contenidoEditar">
                <!-- El contenido se carga dinámicamente -->
            </div>
        </div>
    </div>
</div>

<script>
    // Array para almacenar productos
    let productosCompra = [];
    let contadorProductos = 0;

    // Productos disponibles (se cargan desde PHP)
    const productosDisponibles = <?php echo json_encode($productos); ?>;

    function agregarProducto() {
        contadorProductos++;
        const html = `
        <tr id="fila_${contadorProductos}">
            <td>
                <select name="productos[${contadorProductos}][id_producto]" class="form-control producto-select" onchange="actualizarPrecio(${contadorProductos})" required>
                    <option value="">Seleccione un producto</option>
                    ${productosDisponibles.map(producto => 
                        `<option value="${producto.id_producto}" data-precio="${producto.precio_compra}">
                            ${producto.nombre_producto} (Stock: ${producto.stock})
                        </option>`
                    ).join('')}
                </select>
            </td>
            <td>
                <input type="number" name="productos[${contadorProductos}][cantidad]" class="form-control cantidad-input" 
                       min="1" value="1" onchange="calcularSubtotal(${contadorProductos})" required>
            </td>
            <td>
                <input type="number" name="productos[${contadorProductos}][precio_unitario]" class="form-control precio-input" 
                       step="0.01" min="0.01" onchange="calcularSubtotal(${contadorProductos})" required>
            </td>
            <td>
                <span class="subtotal" id="subtotal_${contadorProductos}">$0.00</span>
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-sm" onclick="eliminarFila(${contadorProductos})">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        </tr>
    `;
        document.getElementById('bodyProductos').insertAdjacentHTML('beforeend', html);
    }

    function actualizarPrecio(fila) {
        const select = document.querySelector(`#fila_${fila} .producto-select`);
        const precioInput = document.querySelector(`#fila_${fila} .precio-input`);

        if (select.value) {
            const precio = select.options[select.selectedIndex].dataset.precio;
            precioInput.value = precio;
            calcularSubtotal(fila);
        }
    }

    function calcularSubtotal(fila) {
        const cantidad = document.querySelector(`#fila_${fila} .cantidad-input`).value;
        const precio = document.querySelector(`#fila_${fila} .precio-input`).value;
        const subtotal = cantidad * precio;

        document.getElementById(`subtotal_${fila}`).textContent = `$${subtotal.toFixed(2)}`;
        calcularTotal();
    }

    function calcularTotal() {
        let total = 0;
        document.querySelectorAll('.subtotal').forEach(element => {
            const valor = parseFloat(element.textContent.replace('$', ''));
            if (!isNaN(valor)) {
                total += valor;
            }
        });
        document.getElementById('totalCompra').textContent = `$${total.toFixed(2)}`;
    }

    function eliminarFila(fila) {
        const filas = document.querySelectorAll('#bodyProductos tr');
        if (filas.length <= 1) {
            Swal.fire({
                icon: 'warning',
                title: 'No permitido',
                text: 'Debe haber al menos un producto en la compra.',
                confirmButtonText: 'Aceptar'
            });
            return;
        }

        document.getElementById(`fila_${fila}`).remove();
        calcularTotal();
    }

    function verDetalleCompra(idCompra) {
        fetch(`../../app/controllers/compras/controller_detalle.php?id=${idCompra}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('contenidoDetalle').innerHTML = data;
                new bootstrap.Modal(document.getElementById('modalVerDetalle')).show();
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error', 'No se pudo cargar el detalle', 'error');
            });
    }

    function editarCompra(idCompra) {
        fetch(`../../app/controllers/compras/controller_editar_form.php?id=${idCompra}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('contenidoEditar').innerHTML = data;
                new bootstrap.Modal(document.getElementById('modalEditarCompra')).show();
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error', 'No se pudo cargar el formulario de edición', 'error');
            });
    }

    // FUNCIONES PARA FILTROS
    function aplicarFiltros() {
        const filtroEstado = document.getElementById('filtroEstado').value.toLowerCase();
        const filtroProveedor = document.getElementById('filtroProveedor').value.toLowerCase();

        const filas = document.querySelectorAll('.fila-compra');
        let filasVisibles = 0;

        filas.forEach((fila, index) => {
            const estado = fila.dataset.estado.toLowerCase();
            const fecha = fila.dataset.fecha;
            const proveedor = fila.dataset.proveedor.toLowerCase();

            let mostrarFila = true;

            // Filtro por estado
            if (filtroEstado && estado !== filtroEstado) {
                mostrarFila = false;
            }

            // Filtro por proveedor
            if (filtroProveedor && !proveedor.includes(filtroProveedor)) {
                mostrarFila = false;
            }

            if (mostrarFila) {
                fila.style.display = '';
                filasVisibles++;
                // Actualizar numeración
                fila.querySelector('td:first-child center').textContent = filasVisibles;
            } else {
                fila.style.display = 'none';
            }
        });

        // Actualizar contador de resultados
        actualizarContador(filasVisibles, filas.length);
    }

    function limpiarFiltros() {
        document.getElementById('filtroEstado').value = '';
        document.getElementById('filtroProveedor').value = '';

        const filas = document.querySelectorAll('.fila-compra');
        filas.forEach((fila, index) => {
            fila.style.display = '';
            // Restaurar numeración original
            fila.querySelector('td:first-child center').textContent = index + 1;
        });

        actualizarContador(filas.length, filas.length);
    }

    function actualizarContador(visibles, total) {
        const contador = document.getElementById('contadorResultados');
        if (visibles === total) {
            contador.textContent = `Mostrando ${total} compras`;
        } else {
            contador.textContent = `Mostrando ${visibles} de ${total} compras`;
        }
    }

    // Event listeners para los filtros
    document.getElementById('filtroEstado').addEventListener('change', aplicarFiltros);
    document.getElementById('filtroProveedor').addEventListener('change', aplicarFiltros);

    // Inicializar contador al cargar la página
    document.addEventListener('DOMContentLoaded', function() {
        const totalFilas = document.querySelectorAll('.fila-compra').length;
        actualizarContador(totalFilas, totalFilas);
    });

    // Agregar una fila de producto por defecto al abrir el modal
    document.getElementById('modalRegistrarCompra').addEventListener('shown.bs.modal', function() {
        if (document.getElementById('bodyProductos').children.length === 0) {
            agregarProducto();
        }
    });
</script>

<?php include('../usuarios/layout/parte2.php'); ?>
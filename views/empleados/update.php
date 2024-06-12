<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/empleados/controller_read.php');
include('../../app/controllers/empleados_servicios/controller_read.php');
include('mensaje.php');
?>
<!--codigo html-->
<div class="container-fluid">
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title"><b>EDITAR EMPLEADO</b></h3>
        </div>
        <div class="card-body">
            <form action="<?php echo $URL ?>/app/controllers/empleados/controller_update.php" method="post">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Nombre del empleado</label>
                            <input name="id_empleado" value="<?php echo $id_empleado ?>" type="text" hidden>
                            <input name="name" value="<?php echo $nombre_empleado ?>" type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Correo electronico</label>
                            <input name="email" value="<?php echo $email ?>" type="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Direccion</label>
                            <input name="direccion" value="<?php echo $direccion ?>" type="text" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">

                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Telefono</label>
                            <input name="telefono" value="<?php echo $telefono ?>" class="form-control" type="text" id="telefonoInput" maxlength="8" placeholder="69794062">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Dui</label>
                            <input name="dui" value="<?php echo $dui ?>" class="form-control" type="text" id="duiInput" maxlength="10" placeholder="05931271-3" pattern="\d{8}-\d" title="Ingrese un DUI válido (ejemplo: 05931271-3)">
                        </div>
                    </div>

                    <!-- Script para formatear el DUI al cargar la página -->
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            var duiInput = document.getElementById("duiInput");
                            var duiValue = duiInput.value;

                            // Aplicar el formato al DUI
                            var formattedDui = formatDui(duiValue);
                            duiInput.value = formattedDui;

                            // Función para aplicar el formato al DUI
                            function formatDui(dui) {
                                return dui.slice(0, 8) + '-' + dui.slice(8);
                            }
                        });
                    </script>

                    <!-- Script para dar formato al DUI (05931271-3) -->
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            const duiInput = document.getElementById("duiInput");

                            duiInput.addEventListener("input", function() {
                                let value = duiInput.value.trim(); // Eliminar espacios en blanco al principio y al final

                                // Verificar si el valor tiene el formato correcto de 9 dígitos seguidos de un guion y un dígito
                                if (/^\d{9}-\d$/.test(value)) {
                                    // El valor tiene el formato correcto, no hacer nada
                                } else {
                                    // Verificar si el valor tiene 9 dígitos seguidos sin guion
                                    if (/^\d{9}$/.test(value)) {
                                        // Formatear el valor agregando un guion antes del último dígito
                                        value = value.slice(0, -1) + "-" + value.slice(-1);
                                    } else if (value.length > 10) {
                                        // Limitar la longitud del valor a 10 caracteres (incluyendo el guion)
                                        value = value.slice(0, 10);
                                    }
                                }
                                // Asignar el valor formateado de vuelta al input
                                duiInput.value = value;
                            });
                        });
                    </script>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Nit</label>
                            <input name="nit" value="<?php echo $nit ?>" class="form-control" type="text" id="nitInput" maxlength="17" placeholder="0614-280899-112-9" pattern="\d{4}-\d{6}-\d{3}-\d" title="Ingrese un NIT válido (ejemplo: 0614-280899-112-9)">
                        </div>
                    </div>
                    <!-- Script para formatear el NIT al cargar la página -->
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            var nitInput = document.getElementById("nitInput");
                            var nitValue = nitInput.value;

                            // Aplicar el formato al NIT
                            var formattedNit = formatNit(nitValue);
                            nitInput.value = formattedNit;

                            // Función para aplicar el formato al NIT
                            function formatNit(nit) {
                                return nit.slice(0, 4) + '-' + nit.slice(4, 7) + nit.slice(7, 10) + '-' + nit.slice(10, 13) + '-' + nit.slice(13);
                            }
                        });
                    </script>

                    <!-- Script para dar formato al NIT (0614-280899-112-9) -->
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            const nitInput = document.getElementById("nitInput");

                            nitInput.addEventListener("input", function() {
                                let value = nitInput.value.trim(); // Eliminar espacios en blanco al principio y al final

                                // Verificar y aplicar formato al NIT (0614-280899-112-9)
                                if (/^\d{4}-\d{6}-\d{3}-\d$/.test(value)) {
                                    // El valor tiene el formato correcto, no hacer nada
                                } else {
                                    // Formatear el valor del NIT agregando guiones en las posiciones correctas
                                    if (value.length === 4 || value.length === 11 || value.length === 15) {
                                        value += "-";
                                    }
                                }
                                // Asignar el valor formateado de vuelta al input
                                nitInput.value = value;
                            });

                            // Permitir borrar caracteres si el usuario se equivoca
                            nitInput.addEventListener("keydown", function(event) {
                                if (event.key === "Backspace" || event.key === "Delete") {
                                    // Si el usuario presiona Backspace o Delete, permitir borrar caracteres
                                    let value = nitInput.value.trim(); // Obtener el valor actual del input

                                    // Verificar si el valor tiene guiones para no borrarlos
                                    if (value.length === 5 || value.length === 12 || value.length === 16) {
                                        value = value.slice(0, -1); // Eliminar el último guion
                                    }
                                    // Asignar el valor modificado de vuelta al input
                                    nitInput.value = value;
                                }
                            });
                        });
                    </script>

                    <div class="col-md-3">
                        <div class="form-group">

                        </div>
                    </div>
                </div>
                <center>
                    <button type="submit" class="btn btn-success">Actualizar</button>
                    <a href="<?php echo $URL ?>/views/empleados" class="btn btn-secondary"> Cancelar</a>
                </center>
            </form>
        </div>
    </div>

<!--tabla servicios
<div class="card card-success">
        <div class="card-header">
            <h3 class="card-title"><b>SERVICIOS</b></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-hover table-bordered table-sm">
                        <thead class="table">
                            <tr>
                                <th scope="col">
                                    <center>#</center>
                                </th>
                                <th scope="col">
                                    <center>Servicios Agregados</center>
                                </th>
                                <th scope="col">
                                    <center>Accion</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $contador = 0;
                            foreach ($empleados_servicios as $empleado_servicio) {
                                $contador++;
                            ?>
                                <tr>
                                    <td>
                                        <center><?php echo $contador ?></center>
                                    </td>
                                    <td>
                                        <center><?php echo $empleado_servicio['nombre_servicio'] ?></center>
                                    </td>
                                    <td>
                                        <form action="<?php echo $URL ?>/app/controllers/empleados_servicios/controller_delete.php" method="post">
                                            <center>
                                                <input type="text" name="id_empleado" value="<?php echo $id_empleado ?>" hidden>
                                                <input type="text" name="id_empleado_servicio" value="<?php echo $empleado_servicio['id_empleado_servicio'] ?>" hidden>
                                                

                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                    <i class="bi bi-trash"></i>
                                                    Eliminar
                                                </button>
                                                

                                                
                                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content modal-centered">
                                                            <div class="modal-header" style="background-color: red;">
                                                                <h1 class="modal-title fs-5" id="staticBackdropLabel"><b>Eliminar Servicio<b></h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>¿Esta seguro de que desea eliminar este servicio</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <center>
                                                                    <button type="submit" class="btn btn-danger">Aceptar</button>
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                                </center>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </center>
                                        </form>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
FIN de servicios-->
    

</div>
<?php
include('../usuarios/layout/parte2.php');

?>
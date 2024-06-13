<?php
include('../usuarios/layout/parte1.php');
include('mensaje.php');
?>
<!--codigo html-->
<div class="container-fluid">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><b>CREAR NUEVO EMPLEADO</b></h3>
        </div>
        <div class="card-body">
            <form action="<?php echo $URL ?>/app/controllers/empleados/controller_create.php" method="post">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Nombre del empleado</label>
                            <input name="name" type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Correo electronico</label>
                            <input name="email""" type="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Direccion</label>
                            <input name="direccion" type="text" class="form-control" required>
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
                            <input name="telefono" class="form-control" type="text" id="telefonoInput" maxlength="8" placeholder="69794062">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Dui</label>
                            <input name="dui" class="form-control" type="text" id="duiInput" maxlength="10" placeholder="05931271-3">
                        </div>
                    </div>
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
                            <input name="nit" class="form-control" type="text" id="nitInput" maxlength="17" placeholder="0614-280899-112-9">
                        </div>
                    </div>


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
                    <button type="submit" class="btn btn-primary">Registrar</button>
                    <a href="<?php echo $URL ?>/views/empleados" class="btn btn-secondary"> Cancelar</a>
                </center>
            </form>
        </div>
    </div>
</div>
<?php
include('../usuarios/layout/parte2.php');

?>
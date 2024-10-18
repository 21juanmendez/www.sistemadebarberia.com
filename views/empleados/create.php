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
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nombre del empleado</label>
                            <input name="name" type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Correo electronico</label>
                            <input name="email" type="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Direccion</label>
                            <input name="direccion" type="text" class="form-control" required>
                        </div>
                    </div>
                </div>

                <!-- Checkbox para homologar DUI y NIT centrado justo arriba de DUI y NIT -->
                <div class="form-group text-center">
                    <label>DUI y NIT homologados</label>
                    <input type="checkbox" id="homologar" name="homologar" value="1" title="Si está homologado, selecciónalo" style="margin-left: 10px;">
                </div>

                <!-- Campos de Teléfono, DUI y NIT, con Teléfono a la derecha y campos más pequeños -->
                <div class="row justify-content-center">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>DUI</label>
                            <input name="dui" class="form-control" type="text" id="duiInput" maxlength="10" placeholder="05931271-3" pattern="\d{8}-\d" title="Ingrese un DUI válido (ejemplo: 05931271-3)" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>NIT</label>
                            <input name="nit" class="form-control" type="text" id="nitInput" maxlength="17" placeholder="0614-280899-112-9" pattern="\d{4}-\d{6}-\d{3}-\d" title="Ingrese un NIT válido (ejemplo: 0614-280899-112-9)" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Teléfono</label>
                            <input name="telefono" class="form-control" type="text" id="telefonoInput" pattern="\d{8}" maxlength="8" placeholder="69794062" title="El numero de telefono debe tener 8 digitos" required>
                        </div>
                    </div>
                </div>

                <center>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                    <a href="<?php echo $URL ?>/views/empleados" class="btn btn-secondary">Cancelar</a>
                </center>
            </form>
        </div>
    </div>
</div>

<!-- Scripts para homologar DUI y NIT -->
<script>
    document.getElementById('homologar').addEventListener('change', function() {
        var duiInput = document.getElementById('duiInput');
        var nitInput = document.getElementById('nitInput');
        
        if (this.checked) {
            nitInput.disabled = true;  // Deshabilitar el campo de NIT
            nitInput.value = '';       // Limpiar el campo de NIT
            
            duiInput.addEventListener('input', function() {
                nitInput.value = duiInput.value; // Copiar valor de DUI al NIT
            });
        } else {
            nitInput.disabled = false; // Habilitar ambos campos
            nitInput.value = '';       // Limpiar el campo de NIT
        }
    });

    // Script para formato del DUI
    document.getElementById('duiInput').addEventListener('input', function(e) {
        var value = this.value.replace(/[^0-9-]/g, ''); // Elimina caracteres no deseados
        if (value.length <= 8) {
            this.value = value.replace(/\D/g, '');
        } else {
            this.value = value.slice(0, 8) + '-' + value.slice(8).replace(/\D/g, '');
        }
    });

    // Script para formato del NIT
    document.getElementById('nitInput').addEventListener('input', function(e) {
        var value = this.value.replace(/[^0-9-]/g, ''); // Elimina caracteres no deseados
        value = value.replace(/\D/g, ''); // Elimina todo lo que no sea dígitos

        var formattedValue = '';
        for (var i = 0; i < value.length; i++) {
            if (i === 4 || i === 10 || i === 13) {
                formattedValue += '-'; // Agrega un guión en las posiciones correctas
            }
            formattedValue += value[i];
        }

        this.value = formattedValue.slice(0, 17); // Limita la longitud máxima a 17 caracteres (incluyendo guiones)
    });
</script>

<?php
include('../usuarios/layout/parte2.php');
?>

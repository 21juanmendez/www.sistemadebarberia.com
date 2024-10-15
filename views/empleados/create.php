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
                            <input name="email" type="email" class="form-control" required>
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
                            <input name="telefono" class="form-control" type="text" id="telefonoInput" pattern="\d{8}" maxlength="8" placeholder="69794062" title="El numero de telefono debe tener 8 digitos" required>
                        </div>
                    </div>
                    <script>
                        document.getElementById('telefonoInput').addEventListener('keydown', function(e) {
                            // Permite solo números y la tecla de borrar
                            if (!/[0-9]/.test(e.key) && e.key !== 'Backspace') {
                                e.preventDefault();
                            }
                        });
                    </script>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Dui</label>
                            <input name="dui" class="form-control" type="text" id="duiInput" maxlength="10" placeholder="05931271-3" pattern="\d{8}-\d" title="Ingrese un DUI válido (ejemplo: 05931271-3)" required>
                        </div>
                    </div>
                    <script>
                        document.getElementById('duiInput').addEventListener('input', function(e) {
                            var value = this.value.replace(/[^0-9-]/g, ''); // Elimina caracteres no deseados
                            if (value.length <= 8) {
                                // Si hay 8 o menos dígitos, solo permite números
                                this.value = value.replace(/\D/g, '');
                            } else {
                                // Si hay más de 8 dígitos, inserta un guión después del octavo dígito y permite números después
                                this.value = value.slice(0, 8) + '-' + value.slice(8).replace(/\D/g, '');
                            }
                        });
                    </script>


                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Nit</label>
                            <input name="nit" class="form-control" type="text" id="nitInput" maxlength="17" placeholder="0614-280899-112-9" pattern="\d{4}-\d{6}-\d{3}-\d" title="Ingrese un NIT válido (ejemplo: 0614-280899-112-9)" required>
                        </div>
                    </div>


                    <!-- Script para dar formato al NIT (0614-280899-112-9) -->
                    <script>
                        document.getElementById('nitInput').addEventListener('input', function(e) {
                            var value = this.value.replace(/[^0-9-]/g, ''); // Elimina caracteres no deseados
                            value = value.replace(/\D/g, ''); // Elimina todo lo que no sea dígitos

                            // Formatea el valor ingresado para que coincida con el patrón
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
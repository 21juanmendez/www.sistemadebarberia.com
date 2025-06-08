<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/gastos/controller_gastos.php');
include('../../app/controllers/categorias_gastos/controller_categorias.php');

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

// Obtener el ID del gasto a actualizar
$id_gasto = $_GET['id_gasto'];

// Consultar los datos del gasto actual
$sql = "SELECT * FROM tb_gastos WHERE id_gasto='$id_gasto'";
$query = $pdo->prepare($sql);
$query->execute();
$gastos = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($gastos as $gasto) {
    $id_categoria_gasto_actual = $gasto['id_categoria_gasto'];
    $descripcion_actual = $gasto['descripcion'];
    $monto_actual = $gasto['monto'];
    $fecha_gasto_actual = $gasto['fecha_gasto'];
}

include('mensaje.php');
?>
<!--codigo html-->
<div class="container-fluid">
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title"><b>ACTUALIZAR GASTO</b></h3>
        </div>
        <div class="card-body">
            <form action="<?php echo $URL ?>/app/controllers/gastos/controller_update.php" method="post" id="formulario">
                <input type="hidden" name="id_gasto" value="<?php echo $id_gasto; ?>">
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Categoría <span class="text-danger">*</span></label>
                                    <select name="id_categoria_gasto" class="form-select" required>
                                        <option value="" disabled>Seleccione una categoría</option>
                                        <?php
                                        foreach ($lista_categorias_gastos as $categoria) {
                                            $selected = ($categoria['id_categoria_gasto'] == $id_categoria_gasto_actual) ? 'selected' : '';
                                        ?>
                                            <option value="<?php echo $categoria['id_categoria_gasto'] ?>" <?php echo $selected; ?>>
                                                <?php echo $categoria['nombre'] ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Monto <span class="text-danger">*</span></label>
                                    <input type="number" name="monto" class="form-control" step="0.01" min="0" 
                                           value="<?php echo $monto_actual; ?>" placeholder="0.00" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fecha del gasto <span class="text-danger">*</span></label>
                                    <input type="date" name="fecha_gasto" class="form-control" 
                                           value="<?php echo $fecha_gasto_actual; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Descripción <span class="text-danger">*</span></label>
                                    <textarea name="descripcion" class="form-control" rows="3" 
                                              placeholder="Ingrese la descripción del gasto..." required><?php echo $descripcion_actual; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <center>
                    <button class="btn btn-warning" type="submit">
                        <i class="bi bi-arrow-repeat"></i> Actualizar Gasto
                    </button>
                    <a href="<?php echo $VIEWS ?>/gastos" class="btn btn-secondary">
                        <i class="bi bi-x-circle-fill"></i> Cancelar
                    </a>
                </center>
            </form>
            
            <script>
                document.addEventListener('DOMContentLoaded', (event) => {
                    const form = document.getElementById('formulario');
                    form.addEventListener('submit', function(e) {
                        const monto = document.querySelector('input[name="monto"]').value;
                        const descripcion = document.querySelector('textarea[name="descripcion"]').value.trim();
                        
                        let showAlert = false;
                        let alertMessage = '';

                        // Validación del monto
                        if (parseFloat(monto) <= 0) {
                            showAlert = true;
                            alertMessage = 'El monto debe ser mayor a 0';
                            const monto_input = document.querySelector('input[name="monto"]');
                            monto_input.setAttribute('data-toggle', 'tooltip');
                            monto_input.setAttribute('data-placement', 'top');
                            monto_input.setAttribute('title', '<i class="bi bi-exclamation-triangle-fill"></i> ' + alertMessage);
                            $(monto_input).tooltip({ html: true }).tooltip('show');
                            setTimeout(() => {
                                $(monto_input).tooltip('dispose');
                            }, 3000);
                        }

                        // Validación de la descripción
                        if (descripcion.length < 5) {
                            showAlert = true;
                            alertMessage = 'La descripción debe tener al menos 5 caracteres';
                            const descripcion_input = document.querySelector('textarea[name="descripcion"]');
                            descripcion_input.setAttribute('data-toggle', 'tooltip');
                            descripcion_input.setAttribute('data-placement', 'top');
                            descripcion_input.setAttribute('title', '<i class="bi bi-exclamation-triangle-fill"></i> ' + alertMessage);
                            $(descripcion_input).tooltip({ html: true }).tooltip('show');
                            setTimeout(() => {
                                $(descripcion_input).tooltip('dispose');
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
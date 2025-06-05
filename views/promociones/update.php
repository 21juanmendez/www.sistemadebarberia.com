<?php
include('../usuarios/layout/parte1.php');
include('../../app/controllers/promociones/controller_read.php');
?>
<!--codigo html-->
<div class="container-fluid">
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title"><b>ACTUALIZAR PROMOCIÓN</b></h3>
        </div>
        <div class="card-body">
            <form action="<?php echo $URL ?>/app/controllers/promociones/controller_update.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="id_promocion" value="<?php echo $id_promocion?>" hidden >
                                    <label>Nombre de la Promoción</label>
                                    <input value="<?php echo $nombre ?>" type="text" name="nombre" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Puntos Requeridos</label>
                                    <input value="<?php echo $puntos_requeridos ?>" type="number" name="puntos_requeridos" class="form-control" step="1" min="1" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Estado</label>
                                    <select name="activo" class="form-control" required>
                                        <option value="1" <?php echo ($activo == 1) ? 'selected' : ''; ?>>Activa</option>
                                        <option value="0" <?php echo ($activo == 0) ? 'selected' : ''; ?>>Inactiva</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Descripción</label>
                                    <textarea name="descripcion" class="form-control" rows="4" required><?php echo $descripcion ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Seleccione la imagen de la promoción</label>
                            <input name="file" class="form-control" type="file" id="file" accept="image/*">
                            <input name="imagen" type="text" value="<?php echo $imagen ?>" hidden>
                            <small class="form-text text-muted">Deja vacío si no deseas cambiar la imagen actual</small>
                            <center>
                                <output id="list">
                                    <br>
                                    <img src="<?php echo $URL . "/public/imagenes/promociones/" . $imagen ?>" width="60%" class="img-thumbnail">
                                </output>
                            </center>
                        </div>
                    </div>
                </div>
                <center>
                    <button class="btn btn-success" type="submit">Actualizar Promoción</button>
                    <a href="<?php echo $VIEWS ?>/promociones" class="btn btn-secondary">Cancelar</a>
                </center>
            </form>
        </div>
    </div>
</div>

<script>
    // Preview de imagen
    function archivo(evt) {
        var files = evt.target.files;
        for (var i = 0, f; f = files[i]; i++) {
            if (!f.type.match('image.*')) {
                continue;
            }
            var reader = new FileReader();
            reader.onload = (function(theFile) {
                return function(e) {
                    document.getElementById("list").innerHTML = ['<img class="thumb thumbnail img-thumbnail" src="', e.target.result, '" width="60%" title="', escape(theFile.name), '"/>'].join('');
                };
            })(f);
            reader.readAsDataURL(f);
        }
    }
    document.getElementById('file').addEventListener('change', archivo, false);
</script>

<?php
include('../usuarios/layout/parte2.php');
?>
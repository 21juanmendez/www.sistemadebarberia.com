<?php
    if (isset($_SESSION['mensajecita'])) { ?>
    <script>
        Swal.fire({
            icon: "warning",
            title: "Oops...",
            text: "¡Necesita Iniciar Sesion para reservar una cita!",
            //footer: '<a href="<?php echo $VIEWS?>/login">Inicie Sesion</a>'
        });
    </script>
    <?php unset($_SESSION['mensajecita']); ?>
    <?php unset($_SESSION['icono']); ?>
<?php
}
?>
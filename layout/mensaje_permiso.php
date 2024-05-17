<?php
    if (isset($_SESSION['mensaje_permiso'])) { ?>
    <script>
        Swal.fire({
            position: "top-center",
            icon: "<?php echo $_SESSION['icono']?>",
            title: "<?php echo $_SESSION['mensaje_permiso'] ?>",
            showConfirmButton: false,
            timer: 2000
        });
    </script>
    <?php unset($_SESSION['mensaje_permiso']); ?>
    <?php unset($_SESSION['icono']); ?>
<?php
}
?>
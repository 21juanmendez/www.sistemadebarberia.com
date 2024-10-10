
$(function () {
    $(".tb_ventass").DataTable({
        "language": {
            "emptyTable": "No hay información"
        },
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "paging": false,
        "info": false, // Desactiva la información de entradas
        "searching": false, // Desactiva el buscador
        "ordering": false
    }).buttons().container().appendTo("#tb_ventass_wrapper .col-md-6:eq(0)");
});

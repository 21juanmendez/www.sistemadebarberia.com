$(function () {
    $("#puntos").DataTable({
        "pageLength": 5,
        "language": {
            "emptyTable": "No hay información sobre canje de puntos",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ transacciones",
            "infoEmpty": "Mostrando 0 a 0 de 0 transacciones",
            "infoFiltered": "(Filtrado de _MAX_ total transacciones)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ transacciones",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar transacción:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        buttons: [{
            extend: "collection",
            text: "Opciones de Reporte",
            orientation: "landscape",
            buttons: [{
                text: "Copiar",
                extend: "copy"
            },
            {
                extend: "pdf",
                text: "Exportar a PDF"
            },
            {
                extend: "csv",
                text: "Exportar a CSV"
            },
            {
                extend: "excel",
                text: "Exportar a Excel"
            },
            {
                text: "Imprimir",
                extend: "print"
            }
            ]
        },
        {
            extend: "colvis",
            text: "Visibilidad de columnas",
        }
        ],
    }).buttons().container().appendTo("#puntos_wrapper .col-md-6:eq(0)");
});

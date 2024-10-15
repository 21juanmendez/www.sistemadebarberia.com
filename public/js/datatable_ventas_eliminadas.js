
$(function () {
    $("#tb_ventas_delete").DataTable({
        "pageLength": 5,
        "language": {
            "emptyTable": "No hay ventas eliminadas",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Ventas eliminadas",
            "infoEmpty": "Msotrando 0 a 0 de 0 Ventas",
            "infoFiltered": "(Filtrado de _MAX_ total Ventas eliminadas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Ventas eliminadas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscador:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        buttons: [{
            extend: "collection",
            text: "Reportes",
            orientation: "landscape",
            buttons: [{
                text: "Copiar",
                extend: "copy"
            },
            {
                extend: "pdf"
            },
            {
                extend: "csv"
            },
            {
                extend: "excel"
            },
            {
                text: "Imprimir",
                extend: "print"
            }
            ]
        },
        {
            extend: "colvis",
            text: "Visor de columnas",
            /* collectionLayout: "fixed three-column" */
        }
        ],
    }).buttons().container().appendTo("#tb_ventas_delete_wrapper .col-md-6:eq(0)");
}
);

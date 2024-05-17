// En el archivo JavaScript

$(document).ready(function () {
    // Inicializar DataTable
    $("#example1").DataTable({
        "pageLength": 5,
        "language": {
            // Configuración del idioma
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Roles",
            "infoEmpty": "Mostrando 0 a 0 de 0 Roles",
            "infoFiltered": "(Filtrado de _MAX_ total Roles)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Roles",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscador:",
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
        // Configuración de botones
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
        }, {
            extend: "colvis",
            text: "Visor de columnas",
            /* collectionLayout: "fixed three-column" */
        }],
    }).buttons().container().appendTo("#example1_wrapper .col-md-6:eq(0)");
});

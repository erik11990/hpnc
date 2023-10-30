var tbl_index_simple;

function list_index_simple() {
    tbl_index_simple = $("#tabla_index").DataTable({
        processing: false,
        serverSide: true,
        ajax: {
            url: "listaringresos",
            type: "get",
        },
        columns: [
            {
                data: "id_ingreso_bodega",
                sClass: "text-center",
            },
            {
                data: "action",
                sClass: "text-center",
                render: function (data, type, row) {
                    return "<button type='button' class='rounded-pill pdf btn btn-success'><i class='far fa-file-pdf'></i></i></button>";
                },
            },
            {
                data: "id_forma",
                sClass: "text-center",
            },
            {
                data: "id_serie",
                sClass: "text-center",
            },
            {
                data: "numero",
                sClass: "text-center",
            },
            {
                data: "factura_serie",
                sClass: "text-center",
            },
            {
                data: "numero_dte",
                sClass: "text-center",
            },
            {
                data: "fecha",
                sClass: "text-center",
            },
            {
                data: "id_proveedor",
                sClass: "text-center",
            },
            {
                data: "id_codigo",
                sClass: "text-center",
            },
            {
                data: "id_libro",
                sClass: "text-center",
            },
            {
                data: "numero_libro",
                sClass: "text-center",
            },
            {
                data: "id_categoria_producto",
                sClass: "text-center",
            },
            {
                data: "id_dependencia",
                sClass: "text-center",
            },
            {
                data: "id_programa",
                sClass: "text-center",
            },
            {
                data: "observaciones",
                sClass: "text-center",
            },
            {
                data: "costo",
                sClass: "text-center",
            },
        ],
        order: [[0, "desc"]],

        language: idioma_espanol,
        select: true,
        scrollX: true,
    });

    tbl_index_simple.on("draw.td", function () {
        var PageInfo = $("#tabla_index").DataTable().page.info();
        tbl_index_simple
            .column(0, { page: "current" })
            .nodes()
            .each(function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            });
    });
}

$("#tabla_index").on("click", ".pdf", function () {
    var data = tbl_index_simple.row($(this).parents("tr")).data(); //En tamaño escritorio
    if (tbl_index_simple.row(this).child.isShown()) {
        var data = tbl_index_simple.row(this).data();
    }
    pdf(data["id_ingreso_bodega"]);
});

function pdf(id_ingreso_bodega) {
    var ruta = "pdf/" + id_ingreso_bodega;
    $("#embed_pdf").attr("src", ruta);

    $("#_pdf_embebido").show();
    $("#_tabla_index").hide();
}

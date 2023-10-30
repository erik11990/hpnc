var tbl_index_simple;

function list_egreso_index_simple() {
    tbl_index_simple = $("#tabla_index_egreso").DataTable({
        processing: false,
        serverSide: true,
        ajax: {
            url: "listaregresos",
            type: "get"
        },
        columns: [
            {
                data: "id_pedido_despacho"
            },
            {
                data: "action",
                render: function (data, type, row) {
                    return "<button type='button' class='rounded-pill pdf_egreso btn btn-info'><i class='far fa-file-pdf'></i></i></button>";
                }
            },
            {
                data: "pedido"
            },
            {
                data: "descripcion"
            }, {
                data: "fecha_pedido"
            }, {
                data: "fecha_ingreso"
            }, {
                data: "fecha_entrega"
            }, {
                data: "nombres_entrega",
                render: function (data, type, row) {
                    return row.nombres_entrega + ' ' + row.apellidos_entrega;
                }
            }, {
                data: "nombres_autoriza",
                render: function (data, type, row) {
                    return row.nombres_autoriza + ' ' + row.apellidos_autoriza;
                }
            }, {
                data: "nombres_paciente",
                render: function (data, type, row) {
                    return(row.nombres_paciente ? row.nombres_paciente : '') + ' ' + (
                    row.apellidos_paciente ? row.apellidos_paciente : ''
                );
                }
            }, {
                data: "nombres_colaborador",
                render: function (data, type, row) {
                    return(row.nombres_colaborador ? row.nombres_colaborador : '') + ' ' + (
                    row.apellidos_colaborador ? row.apellidos_colaborador : ''
                );
                }
            }, {
                data: "descripcion_cat"
            }, {
                data: "total",
                render: function (data, type, row) {
                    return '<strong>Q. ' + data + '</strong>';
                }
            },
        ],
        order: [
            [0, "desc"]
        ],
        language: idioma_espanol,
        select: true,
        scrollX: true
    });

    tbl_index_simple.on("draw.td", function () {
        var PageInfo = $("#tabla_index_egreso").DataTable().page.info();
        tbl_index_simple.column(0, {page: "current"}).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });
}

$("#tabla_index_egreso").on("click", ".pdf_egreso", function () {
    var data = tbl_index_simple.row($(this).parents("tr")).data(); // En tamaño escritorio
    if (tbl_index_simple.row(this).child.isShown()) {
        var data = tbl_index_simple.row(this).data();
    }
    pdf_egreso(data["id_pedido_despacho"]);
});

function pdf_egreso(id_pedido_despacho) {
    var ruta = "pdf_egreso/" + id_pedido_despacho;
    $("#embed_pdf_egreso").attr("src", ruta);

    $("#_pdf_embebido_egreso").show();
    $("#_tabla_index_egreso").hide();
}

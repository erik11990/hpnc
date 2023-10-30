var tbl_categoria_simple;

function list_categoria_simple() {
    tbl_categoria_simple = $("#tabla_categoria_simple").DataTable({
        processing: false,
        serverSide: true,
        ajax: {
            url: "listarcategorias",
            type: "get",
        },
        columns: [
            {
                data: "id_categoria",
                sClass: "text-center",
            },
            {
                data: "descripcion",
                sClass: "text-center",
            },
            {
                data: "action",
                sClass: "text-center",
                render: function (data, type, row) {
                    return "<button type='button' class='editarCategoria btn btn-primary'><i class='fa fa-edit'></i></button>";
                },
            },
        ],
        order: [[0, "desc"]],

        language: idioma_espanol,
        select: true,
    });

    tbl_categoria_simple.on("draw.td", function () {
        var PageInfo = $("#tabla_categoria_simple").DataTable().page.info();
        tbl_categoria_simple
            .column(0, { page: "current" })
            .nodes()
            .each(function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            });
    });
}

function Registrar_categoria() {
    var formData = $("#form_categoria").serialize();

    $.ajax({
        data: formData,
        url: "categorias",
        type: "POST",
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            setTimeout(function () {
                $("#modal_guardado_realizado").show().fadeOut(5000);
            }, 1000);
            tbl_categoria_simple.ajax.reload();
            limpiarFormCategoria();
        },
        error: function (response) {
            if ($("#descripcion").val() != response.responseJSON.descripcion) {
                $("#error_descripcion").text("");
            }
            if ($("#orden").val() != response.responseJSON.orden) {
                $("#error_orden").text("");
            }

            $("#error_descripcion").text(response.responseJSON.descripcion);
            $("#error_orden").text(response.responseJSON.orden);
        },
    });
}

function limpiarFormCategoria() {
    $("#id_categoria").val("");
    $("#descripcion").val("");

    $("#error_descripcion").text("");

    $("#btn_guardar_categoria").show();
    $("#btn_actualizar_categoria").hide();
}

$("#tabla_categoria_simple").on("click", ".editarCategoria", function () {
    $("#btn_guardar_categoria").hide();
    $("#btn_actualizar_categoria").show();

    $("#error_descripcion").text("");
    $("#error_orden").text("");

    var data = tbl_categoria_simple.row($(this).parents("tr")).data(); //En tamaño escritorio
    if (tbl_categoria_simple.row(this).child.isShown()) {
        var data = tbl_categoria_simple.row(this).data();
    } //Permite llevar los datos cuando es tamaño celular y usas el responsive de datatable
    document.getElementById("id_categoria").value = data["id_categoria"];
    document.getElementById("descripcion").value = data["descripcion"];
});

function Actualizar_categoria() {
    let id = document.getElementById("id_categoria").value;
    var formData = $("#form_categoria").serialize();

    $.ajax({
        url: "categorias/" + id,
        data: formData,
        type: "put",
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            setTimeout(function () {
                $("#modal_actualizar").show().fadeOut(5000);
            }, 1000);
            tbl_categoria_simple.ajax.reload();
            limpiarFormCategoria();
        },
        error: function (response) {
            if ($("#descripcion").val() != response.responseJSON.descripcion) {
                $("#error_descripcion").text("");
            }

            $("#error_descripcion").text(response.responseJSON.descripcion);
        },
    });
}

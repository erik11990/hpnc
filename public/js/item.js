function cargar_select_cat() {
    $.ajax({
        url: "selectcategoria",
        type: "get",
    }).done(function (resp) {
        let data = JSON.parse(JSON.stringify(resp));
        let llenardata = "";
        if (data.length > 0) {
            for (let i = 0; i < data.length; i++) {
                llenardata +=
                    "<option value='" +
                    data[i]["id_categoria"] +
                    "'>" +
                    data[i]["descripcion"] +
                    "</option>";
            }

            document.getElementById("id_categoria").innerHTML = llenardata;
        } else {
            llenardata += "<option value=''>No se encontraron datos</option>";
            document.getElementById("select_rol").innerHTML = llenardata;
        }
    });
}

var tbl_item_simple;

function list_item_simple() {
    tbl_item_simple = $("#tabla_item_simple").DataTable({
        processing: false,
        serverSide: true,
        ajax: {
            url: "listaritems",
            type: "get",
        },
        columns: [
            {
                data: "id_item",
                sClass: "text-center",
            },
            {
                data: "categoria",
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
                    return "<button type='button' class='editarItem btn btn-primary'><i class='fa fa-edit'></i></button>";
                },
            },
        ],
        order: [[0, "desc"]],

        language: idioma_espanol,
        select: true,
    });

    tbl_item_simple.on("draw.td", function () {
        var PageInfo = $("#tabla_item_simple").DataTable().page.info();
        tbl_item_simple
            .column(0, { page: "current" })
            .nodes()
            .each(function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            });
    });
}

function Registrar_item() {
    var formData = $("#form_item").serialize();

    $.ajax({
        data: formData,
        url: "items",
        type: "POST",
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            setTimeout(function () {
                $("#modal_guardado_realizado").show().fadeOut(5000);
            }, 1000);
            tbl_item_simple.ajax.reload();
            limpiarFormItem();
        },
        error: function (response) {
            if (
                $("#id_categoria").val() != response.responseJSON.id_categoria
            ) {
                $("#error_id_categoria").text("");
            }
            if ($("#descripcion").val() != response.responseJSON.descripcion) {
                $("#error_descripcion").text("");
            }

            $("#error_id_categoria").text(response.responseJSON.id_categoria);
            $("#error_descripcion").text(response.responseJSON.descripcion);
        },
    });
}

function limpiarFormItem() {
    $("#descripcion").val("");

    $("#error_id_categoria").text("");
    $("#error_descripcion").text("");

    $("#btn_guardar_item").show();
    $("#btn_actualizar_item").hide();
}

$("#tabla_item_simple").on("click", ".editarItem", function () {
    $("#btn_guardar_item").hide();
    $("#btn_actualizar_item").show();

    $("#error_descripcion").text("");

    var data = tbl_item_simple.row($(this).parents("tr")).data(); //En tamaño escritorio
    if (tbl_item_simple.row(this).child.isShown()) {
        var data = tbl_item_simple.row(this).data();
    } //Permite llevar los datos cuando es tamaño celular y usas el responsive de datatable

    document.getElementById("id_item").value = data["id_item"];

    $("#id_categoria").val(data["id_categoria"]);

    document.getElementById("descripcion").value = data["descripcion"];
});

function Actualizar_item() {
    let id = document.getElementById("id_item").value;
    var formData = $("#form_item").serialize();

    $.ajax({
        url: "items/" + id,
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
            tbl_item_simple.ajax.reload();
            limpiarFormItem();
        },
        error: function (response) {
            if ($("#id_categoria").val() != response.responseJSON.id_categoria) {
                $("#error_id_categoria").text("");
            }
            if ($("#descripcion").val() != response.responseJSON.descripcion) {
                $("#error_descripcion").text("");
            }

            $("#error_id_categoria").text(response.responseJSON.id_categoria);
            $("#error_descripcion").text(response.responseJSON.descripcion);
        },
    });
}

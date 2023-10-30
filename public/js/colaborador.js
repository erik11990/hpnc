var tbl_colaborador_simple;

function list_colaborador_simple() {
    tbl_colaborador_simple = $("#tabla_colaborador_simple").DataTable({
        processing: false,
        serverSide: true,
        ajax: {
            url: "listarcolaboradores",
            type: "get",
        },
        columns: [
            {
                data: "id_colaborador",
                sClass: "text-center",
            },
            {
                data: "nombres",
                sClass: "text-center",
            },
            {
                data: "apellidos",
                sClass: "text-center",
            },
            {
                data: "dpi",
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
                    return "<button type='button' class='editarColaborador btn btn-primary'><i class='fa fa-edit'></i></button>";
                },
            },
        ],
        order: [[0, "desc"]],
        scrollX: true,
        language: idioma_espanol,
        select: true,
    });

    tbl_colaborador_simple.on("draw.td", function () {
        var PageInfo = $("#tabla_colaborador_simple").DataTable().page.info();
        tbl_colaborador_simple
            .column(0, { page: "current" })
            .nodes()
            .each(function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            });
    });
}

function Registrar_colaborador() {
    var formData = $("#form_colaborador").serialize();

    $.ajax({
        data: formData,
        url: "colaboradores",
        type: "POST",
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            setTimeout(function () {
                $("#modal_guardado_realizado").show().fadeOut(5000);
            }, 1000);
            tbl_colaborador_simple.ajax.reload();
            limpiarFormColaborador();
        },
        error: function (response) {
            if ($("#id_persona").val() != response.responseJSON.id_persona) {
                $("#error_buscar_persona_x_dpi").text("");
            }
            if (
                $("#id_tipo_colabordor").val() !=
                response.responseJSON.id_tipo_colabordor
            ) {
                $("#error_id_tipo_colabordor").text("");
            }

            $("#error_buscar_persona_x_dpi").text(
                response.responseJSON.id_persona
            );
            $("#error_id_tipo_colabordor").text(
                response.responseJSON.id_tipo_colabordor
            );
        },
    });
}

function limpiarFormColaborador() {
    $("#buscar_persona_x_dpi").val("");
    $("#nombre_persona").text("");
    $("#apellido_persona").text("");
    $("#generales_persona").hide();
    $("#generales_dpi").hide();

    $("#error_buscar_persona_x_dpi").text("");
    $("#error_id_tipo_colabordor").text("");

    $("#btn_guardar_colaborador").show();
    $("#btn_actualizar_colaborador").hide();
}

$("#tabla_colaborador_simple").on("click", ".editarColaborador", function () {
    $("#btn_guardar_colaborador").hide();
    $("#btn_actualizar_colaborador").show();
    $("#generales_persona").show();
    $("#generales_dpi").show();

    $("#error_buscar_persona_x_dpi").text("");
    $("#error_id_tipo_colabordor").text("");

    var data = tbl_colaborador_simple.row($(this).parents("tr")).data();
    if (tbl_colaborador_simple.row(this).child.isShown()) {
        var data = tbl_colaborador_simple.row(this).data();
    }
    document.getElementById("id_colaborador").value = data["id_colaborador"];
    document.getElementById("id_persona").value = data["id_persona"];
    $("#nombre_persona").text(data["nombres"]);
    $("#apellido_persona").text(data["apellidos"]);
    $("#dpi_persona").text(data["dpi"]);
    $("#id_tipo_colabordor").val(data["id_item"]);
});

function Actualizar_colaborador() {
    let id = document.getElementById("id_colaborador").value;
    var formData = $("#form_colaborador").serialize();

    $.ajax({
        url: "colaboradores/" + id,
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
            tbl_colaborador_simple.ajax.reload();
            limpiarFormColaborador();
            cargar_select_tipo_de_colaborador();
        },
        error: function (response) {
            if ($("#id_persona").val() != response.responseJSON.id_persona) {
                $("#error_buscar_persona_x_dpi").text("");
            }
            if (
                $("#id_colaborador").val() !=
                response.responseJSON.id_colaborador
            ) {
                $("#error_id_colaborador").text("");
            }

            $("#error_buscar_persona_x_dpi").text(
                response.responseJSON.id_persona
            );
            $("#error_id_colaborador").text(
                response.responseJSON.id_colaborador
            );
        },
    });
}

function cargar_select_tipo_de_colaborador() {
    $.ajax({
        url: "selecttipocolaborador",
        type: "get",
    }).done(function (resp) {
        let data = JSON.parse(JSON.stringify(resp));
        let llenardata = "";
        if (data.length > 0) {
            for (let i = 0; i < data.length; i++) {
                llenardata +=
                    "<option value='" +
                    data[i]["id_item"] +
                    "'>" +
                    data[i]["descripcion"] +
                    "</option>";
            }

            document.getElementById("id_tipo_colabordor").innerHTML = llenardata;
        } else {
            llenardata += "<option value=''>No se encontraron datos</option>";
            document.getElementById("id_tipo_colabordor").innerHTML =
                llenardata;
        }
    });
}

$("#buscar_persona_x_dpi").keypress(function (e) {
    if (e.which == 13) {
        buscar_persona();
        limpiarFormColaborador();
    }
});

function buscar_persona() {
    var dpi = document.getElementById("buscar_persona_x_dpi").value;

    let formData = new FormData();
    formData.append("dpi", dpi);

    formData.append("_token", $("meta[name='csrf-token']").attr("content"));
    $.ajax({
        url: "buscarpersona",
        type: "post",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.no_data) {
                alert(response.no_data);
            } else {
                $("#id_persona").val(response.id_persona);
                $("#nombre_persona").text(response.nombres);
                $("#apellido_persona").text(response.apellidos);
                $("#dpi_persona").text(response.dpi);

                $("#generales_persona").show();
                $("#generales_dpi").show();
            }
        },
    });
}

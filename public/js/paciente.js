var tbl_paciente_simple;

function list_paciente_simple() {
    tbl_paciente_simple = $("#tabla_paciente_simple").DataTable({
        processing: false,
        serverSide: true,
        ajax: {
            url: "listarpacientes",
            type: "get"
        },
        columns: [
            {
                data: "id_paciente",
                sClass: "text-center"
            },
            {
                data: "nombres",
                sClass: "text-center"
            },
            {
                data: "apellidos",
                sClass: "text-center"
            },
            {
                data: "dpi",
                sClass: "text-center"
            }, {
                data: "descripcion",
                sClass: "text-center"
            }, {
                data: "action",
                sClass: "text-center",
                render: function (data, type, row) {
                    return "<button type='button' class='editarPaciente btn btn-primary'><i class='fa fa-edit'></i></button>";
                }
            },
        ],
        order: [
            [0, "desc"]
        ],
        scrollX: true,
        language: idioma_espanol,
        select: true
    });

    tbl_paciente_simple.on("draw.td", function () {
        var PageInfo = $("#tabla_paciente_simple").DataTable().page.info();
        tbl_paciente_simple.column(0, {page: "current"}).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });
}

function Registrar_paciente() {
    var formData = $("#form_paciente").serialize();

    $.ajax({
        data: formData,
        url: "pacientes",
        type: "POST",
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        success: function (response) {
            setTimeout(function () {
                $("#modal_guardado_realizado").show().fadeOut(5000);
            }, 1000);
            tbl_paciente_simple.ajax.reload();
            limpiarFormPaciente();
        },
        error: function (response) {
            if (response.responseJSON.id_persona == 'El paciente ya existe') {
                limpiarFormPaciente();
            }

            if ($("#id_persona").val() != response.responseJSON.id_persona) {
                $("#error_buscar_persona_x_dpi").text("");
            }
            if ($("#id_tipo_paciente").val() != response.responseJSON.id_tipo_paciente) {
                $("#error_id_tipo_paciente").text("");
            }

            $("#error_buscar_persona_x_dpi").text(response.responseJSON.id_persona);
            $("#error_id_tipo_paciente").text(response.responseJSON.id_tipo_paciente);
        }
    });
}

function limpiarFormPaciente() {
    $("#id_paciente").val("");
    $("#id_persona").val("");

    $("#buscar_persona_x_dpi").val("");
    $("#nombre_persona").text("");
    $("#apellido_persona").text("");
    $("#generales_persona").hide();
    $("#generales_dpi").hide();

    $("#error_buscar_persona_x_dpi").text("");
    $("#error_tipo_paciente").text("");

    $("#btn_guardar_paciente").show();
    $("#btn_actualizar_paciente").hide();
}

$("#tabla_paciente_simple").on("click", ".editarPaciente", function () {
    $("#btn_guardar_paciente").hide();
    $("#btn_actualizar_paciente").show();
    $("#generales_persona").show();
    $("#generales_dpi").show();

    $("#error_buscar_persona_x_dpi").text("");
    $("#error_tipo_paciente").text("");

    var data = tbl_paciente_simple.row($(this).parents("tr")).data();
    if (tbl_paciente_simple.row(this).child.isShown()) {
        var data = tbl_paciente_simple.row(this).data();
    }
    document.getElementById("id_paciente").value = data["id_paciente"];
    document.getElementById("id_persona").value = data["id_persona"];
    $("#nombre_persona").text(data["nombres"]);
    $("#apellido_persona").text(data["apellidos"]);
    $("#dpi_persona").text(data["dpi"]);
    $("#id_tipo_paciente").val(data["id_item"]);
});

function Actualizar_paciente() {
    let id = document.getElementById("id_paciente").value;
    var formData = $("#form_paciente").serialize();

    $.ajax({
        url: "pacientes/" + id,
        data: formData,
        type: "put",
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        success: function (response) {
            setTimeout(function () {
                $("#modal_actualizar").show().fadeOut(5000);
            }, 1000);
            tbl_paciente_simple.ajax.reload();
            limpiarFormPaciente();
            cargar_select_tipo_de_paciente();
        },
        error: function (response) {
            if ($("#id_persona").val() != response.responseJSON.id_persona) {
                $("#error_buscar_persona_x_dpi").text("");
            }
            if ($("#id_tipo_paciente").val() != response.responseJSON.id_tipo_paciente) {
                $("#error_id_tipo_paciente").text("");
            }

            $("#error_buscar_persona_x_dpi").text(response.responseJSON.id_persona);
            $("#error_id_tipo_paciente").text(response.responseJSON.tipo_paciente);
        }
    });
}

function cargar_select_tipo_de_paciente() {
    $.ajax({url: "selecttipopaciente", type: "get"}).done(function (resp) {
        let data = JSON.parse(JSON.stringify(resp));
        let llenardata = "";
        if (data.length > 0) {
            for (let i = 0; i < data.length; i++) {
                llenardata += "<option value='" + data[i]["id_item"] + "'>" + data[i]["descripcion"] + "</option>";
            }

            document.getElementById("id_tipo_paciente").innerHTML = llenardata;
        } else {
            llenardata += "<option value=''>No se encontraron datos</option>";
            document.getElementById("id_tipo_paciente").innerHTML = llenardata;
        }
    });
}

$("#buscar_persona_x_dpi").keypress(function (e) {
    if (e.which == 13) {
        buscar_persona();
        limpiarFormPaciente();
    }
});

function buscar_persona() {
    var dpi = $("#buscar_persona_x_dpi").val();

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
        error: function (response) {
            $('#dpi_requerido').text(response.responseJSON.dpi);

            $('.toast').toast('show');

            setTimeout(function () {
                $('.toast').toast('hide');
            }, 3000);

        }

    });
}

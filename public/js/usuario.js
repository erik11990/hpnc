var tbl_usuario_simple;

function list_usuario_simple() {
    tbl_usuario_simple = $("#tabla_usuario_simple").DataTable({
        processing: false,
        serverSide: true,
        ajax: {
            url: "listarusuarios",
            type: "get"
        },
        columns: [
            {
                data: "id_persona",
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
                data: "fecha_nacimiento",
                sClass: "text-center"
            }, {
                data: "dpi",
                sClass: "text-center"
            }, {
                data: "telefono",
                sClass: "text-center"
            }, {
                data: "id_departamento_residencia",
                sClass: "text-center"
            }, {
                data: "id_municipio_residencia",
                sClass: "text-center"
            }, {
                data: "direccion_residencia",
                sClass: "text-center"
            }, {
                data: "id_estado_civil",
                sClass: "text-center"
            }, {
                data: "nombre_padre",
                sClass: "text-center"
            }, {
                data: "nombre_madre",
                sClass: "text-center"
            }, {
                data: "action",
                sClass: "text-center",
                render: function (data, type, row) {
                    return "<button type='button' class='editarUsuario btn btn-primary'><i class='fa fa-edit'></i></button>";
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

    tbl_usuario_simple.on("draw.td", function () {
        var PageInfo = $("#tabla_usuario_simple").DataTable().page.info();
        tbl_usuario_simple.column(0, {page: "current"}).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });
}

function Registrar_usuario() {
    var formData = $("#form_persona").serialize();

    $.ajax({
        data: formData,
        url: "usuarios",
        type: "POST",
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        success: function (response) {
            setTimeout(function () {
                $("#modal_guardado_realizado").show().fadeOut(5000);
            }, 1000);
            tbl_usuario_simple.ajax.reload();
            limpiarFormUsuario();
        },
        error: function (response) {
            if ($("#nombres").val() != response.responseJSON.nombres) {
                $("#error_nombres").text("");
            }
            if ($("#apellidos").val() != response.responseJSON.nombres) {
                $("#error_apellidos").text("");
            }
            if ($("#fecha_nacimiento").val() != response.responseJSON.nombres) {
                $("#error_fecha_nacimiento").text("");
            }
            if ($("#dpi").val() != response.responseJSON.nombres) {
                $("#error_dpi").text("");
            }
            if ($("#telefono").val() != response.responseJSON.nombres) {
                $("#error_telefono").text("");
            }
            if ($("#id_departamento_residencia").val() != response.responseJSON.nombres) {
                $("#error_id_departamento_residencia").text("");
            }
            if ($("#id_municipio_residencia").val() != response.responseJSON.nombres) {
                $("#error_id_municipio_residencia").text("");
            }
            if ($("#direccion_residencia").val() != response.responseJSON.nombres) {
                $("#error_direccion_residencia").text("");
            }
            if ($("#nombre_padre").val() != response.responseJSON.nombres) {
                $("#error_nombre_padre").text("");
            }
            if ($("#nombre_madre").val() != response.responseJSON.nombres) {
                $("#error_nombre_madre").text("");
            }
            if ($("#id_estado_civil").val() != response.responseJSON.nombres) {
                $("#error_id_estado_civil").text("");
            }

            $("#error_nombres").text(response.responseJSON.nombres);
            $("#error_apellidos").text(response.responseJSON.apellidos);
            $("#error_fecha_nacimiento").text(response.responseJSON.fecha_nacimiento);
            $("#error_dpi").text(response.responseJSON.dpi);
            $("#error_telefono").text(response.responseJSON.telefono);
            $("#error_id_departamento_residencia").text(response.responseJSON.id_departamento_residencia);
            $("#error_id_municipio_residencia").text(response.responseJSON.id_municipio_residencia);
            $("#error_direccion_residencia").text(response.responseJSON.direccion_residencia);
            $("#error_nombre_padre").text(response.responseJSON.nombre_padre);
            $("#error_nombre_madre").text(response.responseJSON.nombre_madre);
            $("#error_id_estado_civil").text(response.responseJSON.id_estado_civil);
        }
    });
}

function limpiarFormUsuario() {
    $("#nombres").val("");
    $("#apellidos").val("");
    $("#fecha_nacimiento").val("");
    $("#dpi").val("");
    $("#telefono").val("");
    $("#direccion_residencia").val("");
    $("#nombre_padre").val("");
    $("#nombre_madre").val("");

    $("#error_nombres").text("");
    $("#error_apellidos").text("");
    $("#error_fecha_nacimiento").text("");
    $("#error_dpi").text("");
    $("#error_telefono").text("");
    $("#error_id_departamento_residencia").text("");
    $("#error_id_municipio_residencia").text("");
    $("#error_direccion_residencia").text("");
    $("#error_nombre_padre").text("");
    $("#error_nombre_madre").text("");
    $("#error_id_estado_civil").text("");

    $("#btn_guardar_usuario").show();
    $("#btn_actualizar_usuario").hide();
}

$("#tabla_usuario_simple").on("click", ".editarUsuario", function () {
    $("#btn_guardar_usuario").hide();
    $("#btn_actualizar_usuario").show();

    $("#error_nombres").text("");
    $("#error_apellidos").text("");
    $("#error_fecha_nacimiento").text("");
    $("#error_dpi").text("");
    $("#error_telefono").text("");
    $("#error_id_departamento_residencia").text("");
    $("#error_id_municipio_residencia").text("");
    $("#error_direccion_residencia").text("");
    $("#error_nombre_padre").text("");
    $("#error_nombre_madre").text("");
    $("#error_id_estado_civil").text("");

    var data = tbl_usuario_simple.row($(this).parents("tr")).data(); // En tamaño escritorio
    if (tbl_usuario_simple.row(this).child.isShown()) {
        var data = tbl_usuario_simple.row(this).data();
    } // Permite llevar los datos cuando es tamaño celular y usas el responsive de datatable
    document.getElementById("id_persona").value = data["id_persona"];
    document.getElementById("nombres").value = data["nombres"];
    document.getElementById("apellidos").value = data["apellidos"];
    document.getElementById("fecha_nacimiento").value = data["fecha_nacimiento"];
    document.getElementById("dpi").value = data["dpi"];
    document.getElementById("telefono").value = data["telefono"];
    $("#id_departamento_residencia").val(data["id_departamento"]);
    recuperar_selectMunicipios(data["id_departamento"], data["id_municipio"]);
    document.getElementById("direccion_residencia").value = data["direccion_residencia"];
    document.getElementById("nombre_padre").value = data["nombre_padre"];
    document.getElementById("nombre_madre").value = data["nombre_madre"];
    $("#id_estado_civil").val(data["id_item"]);
});

function Actualizar_usuario() {
    let id = document.getElementById("id_persona").value;
    var formData = $("#form_persona").serialize();

    $.ajax({
        url: "usuarios/" + id,
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
            tbl_usuario_simple.ajax.reload();
            limpiarFormUsuario();
        },
        error: function (response) {
            if ($("#nombres").val() != response.responseJSON.nombres) {
                $("#error_nombres").text("");
            }
            if ($("#apellidos").val() != response.responseJSON.nombres) {
                $("#error_apellidos").text("");
            }
            if ($("#fecha_nacimiento").val() != response.responseJSON.nombres) {
                $("#error_fecha_nacimiento").text("");
            }
            if ($("#dpi").val() != response.responseJSON.nombres) {
                $("#error_dpi").text("");
            }
            if ($("#telefono").val() != response.responseJSON.nombres) {
                $("#error_telefono").text("");
            }
            if ($("#id_departamento_residencia").val() != response.responseJSON.nombres) {
                $("#error_id_departamento_residencia").text("");
            }
            if ($("#id_municipio_residencia").val() != response.responseJSON.nombres) {
                $("#error_id_municipio_residencia").text("");
            }
            if ($("#direccion_residencia").val() != response.responseJSON.nombres) {
                $("#error_direccion_residencia").text("");
            }
            if ($("#nombre_padre").val() != response.responseJSON.nombres) {
                $("#error_nombre_padre").text("");
            }
            if ($("#nombre_madre").val() != response.responseJSON.nombres) {
                $("#error_nombre_madre").text("");
            }
            if ($("#id_estado_civil").val() != response.responseJSON.nombres) {
                $("#error_id_estado_civil").text("");
            }

            $("#error_nombres").text(response.responseJSON.nombres);
            $("#error_apellidos").text(response.responseJSON.apellidos);
            $("#error_fecha_nacimiento").text(response.responseJSON.fecha_nacimiento);
            $("#error_dpi").text(response.responseJSON.dpi);
            $("#error_telefono").text(response.responseJSON.telefono);
            $("#error_id_departamento_residencia").text(response.responseJSON.id_departamento_residencia);
            $("#error_id_municipio_residencia").text(response.responseJSON.id_municipio_residencia);
            $("#error_direccion_residencia").text(response.responseJSON.direccion_residencia);
            $("#error_nombre_padre").text(response.responseJSON.nombre_padre);
            $("#error_nombre_madre").text(response.responseJSON.nombre_madre);
            $("#error_id_estado_civil").text(response.responseJSON.id_estado_civil);
        }
    });
}

function cargar_select_depatamento() {
    $.ajax({url: "selectdepartamento", type: "get"}).done(function (resp) {
        let data = JSON.parse(JSON.stringify(resp));
        let llenardata = "";
        if (data.length > 0) {
            for (let i = 0; i < data.length; i++) {
                llenardata += "<option value='" + data[i]["id_departamento"] + "'>" + data[i]["descripcion"] + "</option>";
            }

            document.getElementById("id_departamento_residencia").innerHTML = llenardata;
        } else {
            llenardata += "<option value=''>No se encontraron datos</option>";
            document.getElementById("id_departamento_residencia").innerHTML = llenardata;
        }
    });
}

function cargar_select_municipio(departamento_id, targetSelect) {
    $.ajax({
        url: "selectmunicipio?departamento=" + departamento_id,
        type: "get"
    }).done(function (resp) {
        let data = JSON.parse(JSON.stringify(resp));
        let llenardata = "";
        if (data.length > 0) {
            for (let i = 0; i < data.length; i++) {
                llenardata += "<option value='" + data[i]["id_municipio"] + "'>" + data[i]["descripcion"] + "</option>";
            }
        } else {
            llenardata += "<option value=''>No se encontraron datos</option>";
        }
        $(targetSelect).html(llenardata);
        
        var departamento = $("#id_departamento_residencia").val();
        valor(departamento);
    });
}

function valor(departamento) {
    if (departamento == 1) {
        cargar_select_municipio(departamento, "#id_municipio_residencia");
    }
}

$("#id_departamento_residencia").on("change", function () {
    var departamento_id = $(this).val();
    cargar_select_municipio(departamento_id, "#id_municipio_residencia");
});

function recuperar_selectMunicipios(departamento_id, recuperar_municipio) {
    $.ajax({
        url: "selectmunicipio?departamento=" + departamento_id,
        type: "get"
    }).done(function (resp) {
        let data = JSON.parse(JSON.stringify(resp));
        let llenardata = "";
        if (data.length > 0) {
            for (let i = 0; i < data.length; i++) {
                llenardata += "<option value='" + data[i]["municipio_id"] + "'>" + data[i]["descripcion"] + "</option>";
            }
            $("#id_municipio_residencia").html(llenardata);

            $("#id_municipio_residencia option").each(function () {
                if ($(this).val() == recuperar_municipio) {
                    $(this).prop("selected", true);
                }
            });
        } else {
            llenardata += "<option value=''>No se encontraron datos</option>";
            $("#id_municipio_residencia").html(llenardata);
        }
    });
}


function cargar_select_estado_civil() {
    $.ajax({url: "selectestadocivil", type: "get"}).done(function (resp) {
        let data = JSON.parse(JSON.stringify(resp));
        let llenardata = "";
        if (data.length > 0) {
            for (let i = 0; i < data.length; i++) {
                llenardata += "<option value='" + data[i]["id_item"] + "'>" + data[i]["descripcion"] + "</option>";
            }

            document.getElementById("id_estado_civil").innerHTML = llenardata;
        } else {
            llenardata += "<option value=''>No se encontraron datos</option>";
            document.getElementById("id_estado_civil").innerHTML = llenardata;
        }
    });
}

var tbl_user_simple;

function list_user_simple() {
    tbl_user_simple = $("#tabla_user_simple").DataTable({
        processing: false,
        serverSide: true,
        ajax: {
            url: "listarusers",
            type: "get"
        },
        columns: [
            {
                data: "id"
            },
            {
                data: "name"
            },
            {
                data: "email"
            },
            {
                data: "rol",
                render: function (data, type, row) {
                    var roles = {
                        "1": "Administrador",
                        "2": "Ingreso",
                        "3": "Egreso"
                    };

                    return roles[data] || 'Rol Desconocido';
                }
            }, {
                data: "action",
                render: function (data, type, row) {
                    return "<button type='button' class='editarUser btn btn-primary'><i class='fa fa-edit'></i></button>";
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

    tbl_user_simple.on("draw.td", function () {
        var PageInfo = $("#tabla_user_simple").DataTable().page.info();
        tbl_user_simple.column(0, {page: "current"}).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });
}

function Registrar_user() {
    var formData = $("#form_user").serialize();

    $.ajax({
        data: formData,
        url: "crearusuario",
        type: "POST",
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        success: function (response) {
            setTimeout(function () {
                $("#modal_guardado_realizado").show().fadeOut(5000);
            }, 1000);
            tbl_user_simple.ajax.reload();
            limpiarFormUsuario();
        },
        error: function (response) {
            if (response && response.responseJSON) {
                var errores = response.responseJSON;

                var mensajes = '';
                for (var campo in errores) {
                    if (errores.hasOwnProperty(campo)) {
                        var mensajesCampo = errores[campo];
                        mensajes += "<strong>" + campo + ":</strong> " + mensajesCampo.join(", ") + "<br>";
                    }
                }

                $('#errores').html(mensajes);
                $('.toast').toast('show');

                setTimeout(function () {
                    $('.toast').toast('hide');
                }, 10000);
            } else {
                var mensaje = "Se produjo un error desconocido.";
                $('#errores').text(mensaje);
                $('.toast').toast('show');

                setTimeout(function () {
                    $('.toast').toast('hide');
                }, 3000);
            }
        }
    });
}

function limpiarFormUsuario() {
    $('#name').val('');
    $('#email').val('');
    $('#password').val('');
    $('#passwordConfirm').val('');
    $('#rol').val('');
    $('#id').val('');
    roles();
}

$("#tabla_user_simple").on("click", ".editarUser", function () {
    $("#btn_guardar_usuario").hide();
    $("#btn_actualizar_usuario").show();

    var data = tbl_user_simple.row($(this).parents("tr")).data();
    if (tbl_user_simple.row(this).child.isShown()) {
        var data = tbl_user_simple.row(this).data();
    }

    $("#id").val(data["id"]);
    $("#name").val(data["name"]);
    $("#email").val(data["email"]);
    $("#rol").val(data["rol"]);
    $('#btn_user_update').show();
    $('#btn_user').hide();
});

function Actualizar_user() {
    let id = $("#id").val();
    var formData = $("#form_user").serialize();

    $.ajax({
        url: "crearusuario/" + id,
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
            tbl_user_simple.ajax.reload();
            limpiarFormUsuario();
        },
        error: function (response) {
            if (response && response.responseJSON) {
                var errores = response.responseJSON;

                var mensajes = '';
                for (var campo in errores) {
                    if (errores.hasOwnProperty(campo)) {
                        var mensajesCampo = errores[campo];
                        mensajes += "<strong>" + campo + ":</strong> " + mensajesCampo.join(", ") + "<br>";
                    }
                }

                $('#errores').html(mensajes);
                $('.toast').toast('show');

                setTimeout(function () {
                    $('.toast').toast('hide');
                }, 10000);
            } else {
                var mensaje = "Se produjo un error desconocido.";
                $('#errores').text(mensaje);
                $('.toast').toast('show');

                setTimeout(function () {
                    $('.toast').toast('hide');
                }, 3000);
            }
        }
    });
}

function roles() {
    $.ajax({
        url: 'roles',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            let llenardata = "";
            if (Object.keys(data).length > 0) {
                $.each(data, function (key, value) {
                    llenardata += "<option value='" + key + "'>" + value + "</option>";
                });

                $("#rol").html(llenardata);
            } else {
                llenardata += "<option value=''>No se encontraron datos</option>";
                $("#rol").html(llenardata);
            }
        },
        error: function (error) {
            console.error(error);
        }
    });

}

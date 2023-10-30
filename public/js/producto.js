var tbl_producto_simple;

function list_producto_simple() {
    tbl_producto_simple = $("#tabla_producto_simple").DataTable({
        processing: false,
        serverSide: true,
        ajax: {
            url: "listarproductos",
            type: "get"
        },
        columns: [
            {
                data: "id_producto",
                sClass: "text-center"
            },
            {
                data: "categoria",
                sClass: "text-center"
            },
            {
                data: "af",
                sClass: "text-center"
            },
            {
                data: "producto",
                sClass: "text-center"
            }, {
                data: "stock",
                sClass: "text-center"
            }, {
                data: "action",
                sClass: "text-center",
                render: function (data, type, row) {
                    return "<button type='button' class='editarProducto btn btn-primary'><i class='fa fa-edit'></i></button>";
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

    tbl_producto_simple.on("draw.td", function () {
        var PageInfo = $("#tabla_producto_simple").DataTable().page.info();
        tbl_producto_simple.column(0, {page: "current"}).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });
}

function Registrar_producto() {
    var formData = $("#form_productos").serialize();

    $.ajax({
        data: formData,
        url: "productos",
        type: "POST",
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        success: function (response) {
            setTimeout(function () {
                $("#modal_guardado_realizado").show().fadeOut(5000);
            }, 1000);
            tbl_producto_simple.ajax.reload();
            limpiarFormProducto();
            $("#oculatar_div_af").hide();
        },
        error: function (response) {
            if ($("#id_categoria_mp").val() != response.responseJSON.id_categoria_mp) {
                $("#error_id_categoria_mp").text("");
            }
            if ($("#id_accion_farmacologica").val() != response.responseJSON.id_accion_farmacologica) {
                $("#error_id_accion_farmacologica").text("");
            }
            if ($("#descripcion").val() != response.responseJSON.descripcion) {
                $("#error_descripcion").text("");
            }

            $("#error_id_categoria").text(response.responseJSON.id_categoria);
            $("#error_id_accion_farmacologica").text(response.responseJSON.id_accion_farmacologica);
            $("#error_descripcion").text(response.responseJSON.descripcion);
        }
    });
}

function limpiarFormProducto() {
    selectCategoriaProducto();
    cargar_select_AccionFarmacologica();
    $("#descripcion").val("");
    $("#stock").val("");

    $("#error_id_categoria_mp").text("");
    $("#error_id_accion_farmacologica").text("");
    $("#error_descripcion").text("");

    $("#btn_guardar_producto").show();
    $("#btn_actualizar_producto").hide();
}

$("#tabla_producto_simple").on("click", ".editarProducto", function () {
    $("#btn_guardar_producto").hide();
    $("#btn_actualizar_producto").show();

    var data = tbl_producto_simple.row($(this).parents("tr")).data();
    if (tbl_producto_simple.row(this).child.isShown()) {
        var data = tbl_producto_simple.row(this).data();
    }
    if (data["id_categoria"] == 26) {
        $("#oculatar_div_af").show();
    } else {
        $("#oculatar_div_af").hide();
    }

    $("#id_categoria_mp").val(data["id_categoria"]);
    $("#id_accion_farmacologica").val(data["id_accion_farmacologica"]);


    document.getElementById("id_producto").value = data["id_producto"];
    document.getElementById("descripcion").value = data["producto"];
    document.getElementById("stock").value = data["stock"];

});

function Actualizar_producto() {
    let id = document.getElementById("id_producto").value;
    var formData = $("#form_productos").serialize();

    $.ajax({
        url: "productos/" + id,
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
            tbl_producto_simple.ajax.reload();
            limpiarFormProducto();
            $("#oculatar_div_af").hide();
        },
        error: function (response) {
            if ($("#id_categoria_mp").val() != response.responseJSON.id_categoria_mp) {
                $("#error_id_categoria_mp").text("");
            }
            if ($("#id_accion_farmacologica").val() != response.responseJSON.id_accion_farmacologica) {
                $("#error_id_accion_farmacologica").text("");
            }
            if ($("#descripcion").val() != response.responseJSON.descripcion) {
                $("#error_descripcion").text("");
            }

            $("#error_id_categoria").text(response.responseJSON.id_categoria);
            $("#error_id_accion_farmacologica").text(response.responseJSON.id_accion_farmacologica);
            $("#error_descripcion").text(response.responseJSON.descripcion);
        }
    });
}

function selectCategoriaProducto() {
    $.ajax({url: "selectcategoriaproducto", type: "get"}).done(function (resp) {
        let data = JSON.parse(JSON.stringify(resp));
        let llenardata = "";
        if (data.length > 0) {
            for (let i = 0; i < data.length; i++) {
                llenardata += "<option value='" + data[i]["id_item"] + "'>" + data[i]["descripcion"] + "</option>";
            }

            document.getElementById("id_categoria_mp").innerHTML = llenardata;
        } else {
            llenardata += "<option value=''>No se encontraron datos</option>";
            document.getElementById("id_categoria_mp").innerHTML = llenardata;
        }
    });
}

function cargar_select_AccionFarmacologica() {
    $("#id_categoria_mp").on("change", function () {
        $("#id_categoria_mp option:selected").each(function () {
            var af = $(this).val();
            if (af == 26) {
                $("#oculatar_div_af").show();
            } else {
                $("#oculatar_div_af").hide();
            }
            $.ajax({url: "selectaccionfarmacologica", type: "get"}).done(function (resp) {
                let data = JSON.parse(JSON.stringify(resp));
                let llenardata = "";
                if (data.length > 0) {
                    for (let i = 0; i < data.length; i++) {
                        llenardata += "<option value='" + data[i]["id_item"] + "'>" + data[i]["descripcion"] + "</option>";
                    }

                    document.getElementById("id_accion_farmacologica").innerHTML = llenardata;
                } else {
                    llenardata += "<option value=''>No se encontraron datos</option>";
                    document.getElementById("id_accion_farmacologica").innerHTML = llenardata;
                }
            });
        });
    });
}

function Registrar_ingreso() {
    var formData = $("#form_ingreso").serialize();
    $.ajax({
        data: formData,
        url: "bodega",
        type: "POST",
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            setTimeout(function () {
                $("#modal_guardado_realizado").show().fadeOut(5000);
            }, 1000);
            limpiar_select_detalles();
            limpiar_ingreso();
            limpiar_detalles();
            $("#tabla_detalles").DataTable().clear().draw();
        },
        error: function (response) {
            if ($("#error_id_forma").val() != response.responseJSON.id_forma) {
                $("#error_id_forma").text("");
            }
            if ($("#error_id_serie").val() != response.responseJSON.id_serie) {
                $("#error_id_serie").text("");
            }
            if ($("#error_numero").val() != response.responseJSON.numero) {
                $("#error_numero").text("");
            }
            if (
                $("#error_factura_serie").val() !=
                response.responseJSON.factura_serie
            ) {
                $("#error_factura_serie").text("");
            }
            if (
                $("#error_numero_dte").val() != response.responseJSON.numero_dte
            ) {
                $("#error_numero_dte").text("");
            }
            if ($("#error_fecha").val() != response.responseJSON.fecha) {
                $("#error_fecha").text("");
            }
            if (
                $("#error_id_proveedor").val() !=
                response.responseJSON.id_proveedor
            ) {
                $("#error_id_proveedor").text("");
            }
            if (
                $("#error_id_codigo").val() != response.responseJSON.id_codigo
            ) {
                $("#error_id_codigo").text("");
            }
            if ($("#error_id_libro").val() != response.responseJSON.id_libro) {
                $("#error_id_libro").text("");
            }
            if (
                $("#error_numero_libro").val() !=
                response.responseJSON.numero_libro
            ) {
                $("#error_numero_libro").text("");
            }
            if (
                $("#error_id_categoria_producto").val() !=
                response.responseJSON.id_categoria_producto
            ) {
                $("#error_id_categoria_producto").text("");
            }
            if (
                $("#error_id_dependencia").val() !=
                response.responseJSON.id_dependencia
            ) {
                $("#error_id_dependencia").text("");
            }
            if (
                $("#error_id_programa").val() !=
                response.responseJSON.id_programa
            ) {
                $("#error_id_programa").text("");
            }
            if (
                $("#error_observaciones").val() !=
                response.responseJSON.observaciones
            ) {
                $("#error_observaciones").text("");
            }
            if ($("#error_costo").val() != response.responseJSON.costo) {
                $("#error_costo").text("");
            }

            $("#error_id_forma").text(response.responseJSON.id_forma);
            $("#error_id_serie").text(response.responseJSON.id_serie);
            $("#error_numero").text(response.responseJSON.numero);
            $("#error_factura_serie").text(response.responseJSON.factura_serie);
            $("#error_numero_dte").text(response.responseJSON.numero_dte);
            $("#error_fecha").text(response.responseJSON.fecha);
            $("#error_id_proveedor").text(response.responseJSON.id_proveedor);
            $("#error_id_codigo").text(response.responseJSON.id_codigo);
            $("#error_id_libro").text(response.responseJSON.id_libro);
            $("#error_numero_libro").text(response.responseJSON.numero_libro);
            $("#error_id_categoria_producto").text(
                response.responseJSON.id_categoria_producto
            );
            $("#error_id_dependencia").text(
                response.responseJSON.id_dependencia
            );
            $("#error_id_programa").text(response.responseJSON.id_programa);
            $("#error_observaciones").text(response.responseJSON.observaciones);
            $("#error_costo").text(response.responseJSON.costo);
        },
    });
}

var cont = 0;
total = 0;
subtotal = [];

function Agregar_prodcuto() {
    id_accion_farmacologica = $("#id_accion_farmacologica").val();
    id_nombre_producto = $("#id_nombre_producto").val();
    id_laboratorio = $("#id_laboratorio").val();
    concentracion = $("#concentracion").val();
    id_presentacion_unidad_de_medida = $("#id_presentacion_unidad_de_medida").val();
    id_marca = $("#id_marca").val();
    lote = $("#lote").val();
    fecha_vencimiento = $("#fecha_vencimiento").val();
    cantidad = $("#cantidad").val();
    precio_unidad = $("#precio_unidad").val();
    id_codigo_gasto_renglon = $("#id_codigo_gasto_renglon").val();
    orden_cp_y_p_numero = $("#orden_cp_y_p_numero").val();
    folio_libro_inventario = $("#folio_libro_inventario").val();
    nomenclatura_de_cuentas = $("#nomenclatura_de_cuentas").val();
    folio_almacen = $("#folio_almacen").val();

    aux_id_accion_farmacologica = $(
        "#id_accion_farmacologica option:selected"
    ).text();
    aux_id_nombre_producto = $("#id_nombre_producto option:selected").text();
    aux_id_laboratorio = $("#id_laboratorio option:selected").text();
    aux_id_presentacion_unidad_de_medida = $(
        "#id_presentacion_unidad_de_medida option:selected"
    ).text();
    aux_id_marca = $("#id_marca option:selected").text();
    aux_id_codigo_gasto_renglon = $(
        "#id_codigo_gasto_renglon option:selected"
    ).text();

    subtotal[cont] = cantidad * precio_unidad;
    total = total + subtotal[cont];

    var fila =
        '<tr class ="text-center selected" id = "fila' +
        cont +
        '" >' +
        '<td><button type="button" class = "btn btn-danger btn-sm" onclick="eliminarFila(' +
        cont +
        ');"><i class="fa fa-times fa-2x"></i></button></dt>' +
        '<td><input type="hidden" name = "id_accion_farmacologica[]" value = "' +
        id_accion_farmacologica +
        '">' +
        aux_id_accion_farmacologica +
        "</td>" +
        '<td><input type="hidden" name = "id_nombre_producto[]" value = "' +
        id_nombre_producto +
        '">' +
        aux_id_nombre_producto +
        "</td>" +
        '<td><input type="hidden" name = "id_laboratorio[]" value = "' +
        id_laboratorio +
        '">' +
        aux_id_laboratorio +
        "</td>" +
        '<td><input type="hidden" name = "concentracion[]" value = "' +
        concentracion +
        '">' +
        concentracion +
        "</td>" +
        '<td><input type="hidden" name = "id_presentacion_unidad_de_medida[]" value = "' +
        id_presentacion_unidad_de_medida +
        '">' +
        aux_id_presentacion_unidad_de_medida +
        "</td>" +
        '<td><input type="hidden" name = "id_marca[]" value = "' +
        id_marca +
        '">' +
        aux_id_marca +
        "</td>" +
        '<td><input type="hidden" name = "lote[]" value = "' +
        lote +
        '">' +
        lote +
        "</td>" +
        '<td><input type="hidden" name = "fecha_vencimiento[]" value = "' +
        fecha_vencimiento +
        '">' +
        fecha_vencimiento +
        "</td>" +
        '<td><input type="hidden" name = "cantidad[]" value = "' +
        cantidad +
        '">' +
        cantidad +
        "</td>" +
        '<td><input type="hidden" name = "precio_unidad[]" value = "' +
        precio_unidad +
        '">' +
        precio_unidad +
        "</td>" +
        '<td><input type="hidden" name = "id_codigo_gasto_renglon[]" value = "' +
        id_codigo_gasto_renglon +
        '">' +
        aux_id_codigo_gasto_renglon +
        "</td>" +
        '<td><input type="hidden" name = "orden_cp_y_p_numero[]" value = "' +
        orden_cp_y_p_numero +
        '">' +
        orden_cp_y_p_numero +
        "</td>" +
        '<td><input type="hidden" name = "folio_libro_inventario[]" value = "' +
        folio_libro_inventario +
        '">' +
        folio_libro_inventario +
        "</td>" +
        '<td><input type="hidden" name = "nomenclatura_de_cuentas[]" value = "' +
        nomenclatura_de_cuentas +
        '">' +
        nomenclatura_de_cuentas +
        "</td>" +
        '<td><input type="hidden" name = "folio_almacen[]" value = "' +
        folio_almacen +
        '">' +
        folio_almacen +
        "</td>" +
        "<td>" +
        "Q. " +
        subtotal[cont] +
        "</td>" +
        "</tr>";

    cont++;

    limpiar_detalles();

    $("#costo").val(total);
    $("#tabla_detalles").append(fila);
}

function botonCancelar(){
    limpiar_select_detalles();
    limpiar_ingreso();
    limpiar_detalles();
    $("#tabla_detalles").DataTable().clear().draw();
}

function limpiar_select_detalles() {
    selectidaccionfarmacologica();
    selectselectidnombreproducto();
    selectidlaboratorio();
    selectidpresentacionunidaddemedida();
    selectidmarca();
    selectidcodigogastorenglon();
}

function limpiar_ingreso() {
    $("#numero").val("");
    $("#factura_serie").val("");
    $("#numero_dte").val("");
    $("#fecha").val("");
    $("#numero_libro").val("");
    $("#observaciones").val("");
    $("#costo").val("");

    $("#error_numero").text("");
    $("#error_factura_serie").text("");
    $("#error_numero_dte").text("");
    $("#error_fecha").text("");
    $("#error_numero_libro").text("");
    $("#error_observaciones").text("");
    $("#error_costo").text("");

    selectForma();
    selectSerie();
    selectProveedor();
    selectCodigo();
    selectLibro();
    selectCategoriaProducto();
    selectDependencia();
    selectPrograma();
}

function limpiar_detalles() {
    $("#concentracion").val("");
    $("#lote").val("");
    $("#fecha_vencimiento").val("");
    $("#cantidad").val("");
    $("#precio_unidad").val("");
    $("#orden_cp_y_p_numero").val("");
    $("#folio_libro_inventario").val("");
    $("#nomenclatura_de_cuentas").val("");
    $("#folio_almacen").val("");
}

function eliminarFila(cont) {
    total = total - subtotal[cont];
    $("#fila" + cont).remove();
    $("#costo").val(total);

    if (cont == 0) {
        $("#costo").val("");
    }
}

function selectForma() {
    $.ajax({
        url: "selectforma",
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

            document.getElementById("id_forma").innerHTML = llenardata;
        } else {
            llenardata += "<option value=''>No se encontraron datos</option>";
            document.getElementById("id_forma").innerHTML = llenardata;
        }
    });
}

function selectSerie() {
    $.ajax({
        url: "selectserie",
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

            document.getElementById("id_serie").innerHTML = llenardata;
        } else {
            llenardata += "<option value=''>No se encontraron datos</option>";
            document.getElementById("id_serie").innerHTML = llenardata;
        }
    });
}

function selectProveedor() {
    $.ajax({
        url: "selectproveedor",
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

            document.getElementById("id_proveedor").innerHTML = llenardata;
        } else {
            llenardata += "<option value=''>No se encontraron datos</option>";
            document.getElementById("id_proveedor").innerHTML = llenardata;
        }
    });
}

function selectCodigo() {
    $.ajax({
        url: "selectcodigo",
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

            document.getElementById("id_codigo").innerHTML = llenardata;
        } else {
            llenardata += "<option value=''>No se encontraron datos</option>";
            document.getElementById("id_codigo").innerHTML = llenardata;
        }
    });
}

function selectLibro() {
    $.ajax({
        url: "selectlibro",
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

            document.getElementById("id_libro").innerHTML = llenardata;
        } else {
            llenardata += "<option value=''>No se encontraron datos</option>";
            document.getElementById("id_libro").innerHTML = llenardata;
        }
    });
}

function selectCategoriaProducto() {
    $.ajax({
        url: "selectcategoriaproducto",
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

            document.getElementById("id_categoria_producto").innerHTML =
                llenardata;
        } else {
            llenardata += "<option value=''>No se encontraron datos</option>";
            document.getElementById("id_categoria_producto").innerHTML =
                llenardata;
        }
    });
}

function selectselectidnombreproducto(categoria_producto) {
    $("#id_categoria_producto").on("change", function () {
        $("#id_categoria_producto option:selected").each(function () {
            var categoria_producto = $(this).val();
            $.ajax({
                url:
                    "selectselectidnombreproducto?categoria_producto=" +
                    categoria_producto,
                type: "get",
            }).done(function (resp) {
                let data = JSON.parse(JSON.stringify(resp));
                let llenardata = "";
                if (data.length > 0) {
                    for (let i = 0; i < data.length; i++) {
                        llenardata +=
                            "<option value='" +
                            data[i]["id_producto"] +
                            "'>" +
                            data[i]["descripcion"] +
                            "</option>";
                    }

                    document.getElementById("id_nombre_producto").innerHTML =
                        llenardata;
                } else {
                    llenardata +=
                        "<option value=''>No se encontraron datos</option>";
                    document.getElementById("id_nombre_producto").innerHTML =
                        llenardata;
                }
            });
        });
    });
}

function selectDependencia() {
    $.ajax({
        url: "selectdependencia",
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

            document.getElementById("id_dependencia").innerHTML = llenardata;
        } else {
            llenardata += "<option value=''>No se encontraron datos</option>";
            document.getElementById("id_dependencia").innerHTML = llenardata;
        }
    });
}

function selectPrograma() {
    $.ajax({
        url: "selectprograma",
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

            document.getElementById("id_programa").innerHTML = llenardata;
        } else {
            llenardata += "<option value=''>No se encontraron datos</option>";
            document.getElementById("id_programa").innerHTML = llenardata;
        }
    });
}

function selectidaccionfarmacologica() {
    $.ajax({
        url: "selectidaccionfarmacologica",
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

            document.getElementById("id_accion_farmacologica").innerHTML =
                llenardata;
        } else {
            llenardata += "<option value=''>No se encontraron datos</option>";
            document.getElementById("id_accion_farmacologica").innerHTML =
                llenardata;
        }
    });
}

function selectidlaboratorio() {
    $.ajax({
        url: "selectidlaboratorio",
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

            document.getElementById("id_laboratorio").innerHTML = llenardata;
        } else {
            llenardata += "<option value=''>No se encontraron datos</option>";
            document.getElementById("id_laboratorio").innerHTML = llenardata;
        }
    });
}

function selectidpresentacionunidaddemedida() {
    $.ajax({
        url: "selectidpresentacionunidaddemedida",
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

            document.getElementById(
                "id_presentacion_unidad_de_medida"
            ).innerHTML = llenardata;
        } else {
            llenardata += "<option value=''>No se encontraron datos</option>";
            document.getElementById(
                "id_presentacion_unidad_de_medida"
            ).innerHTML = llenardata;
        }
    });
}

function selectidmarca() {
    $.ajax({
        url: "selectidmarca",
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

            document.getElementById("id_marca").innerHTML = llenardata;
        } else {
            llenardata += "<option value=''>No se encontraron datos</option>";
            document.getElementById("id_marca").innerHTML = llenardata;
        }
    });
}

function selectidcodigogastorenglon() {
    $.ajax({
        url: "selectidcodigogastorenglon",
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

            document.getElementById("id_codigo_gasto_renglon").innerHTML =
                llenardata;
        } else {
            llenardata += "<option value=''>No se encontraron datos</option>";
            document.getElementById("id_codigo_gasto_renglon").innerHTML =
                llenardata;
        }
    });
}

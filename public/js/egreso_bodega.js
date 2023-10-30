function Registrar_egreso() {
    var formData = $("#form_egreso").serialize();
    $.ajax({
        data: formData,
        url: "egresobodega",
        type: "POST",
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        success: function (response) {
            setTimeout(function () {
                $("#modal_guardado_realizado").show().fadeOut(5000);
            }, 1000);
            limpiar_select_detalles();
            limpiar_egreso();
            limpiar_detalles();
            $("#tabla_detalles_egreso").DataTable().clear().draw();
        },
        error: function (response) {
            if ($("#error_pedido").val() != response.responseJSON.pedido) {
                $("#error_pedido").text("");
            }
            if ($("#error_id_lugar").val() != response.responseJSON.id_lugar) {
                $("#error_id_lugar").text("");
            }
            if ($("#error_fecha_pedido").val() != response.responseJSON.fecha_pedido) {
                $("#error_fecha_pedido").text("");
            }
            if ($("#error_fecha_ingreso").val() != response.responseJSON.fecha_ingreso) {
                $("#error_fecha_ingreso").text("");
            }
            if ($("#error_fecha_entrega").val() != response.responseJSON.fecha_entrega) {
                $("#error_fecha_entrega").text("");
            }
            if ($("#error_id_entrega").val() != response.responseJSON.id_entrega) {
                $("#error_id_entrega").text("");
            }
            if ($("#error_id_autoriza").val() != response.responseJSON.id_autoriza) {
                $("#error_id_autoriza").text("");
            }
            if ($("#error_id_solicitante").val() != response.responseJSON.id_solicitante) {
                $("#error_id_solicitante").text("");
            }
            if ($("#error_id_categoria_producto").val() != response.responseJSON.id_categoria_producto) {
                $("#error_id_categoria_producto").text("");
            }
            if ($("#error_total").val() != response.responseJSON.total) {
                $("#error_total").text("");
            }

            $("#error_pedido").text(response.responseJSON.pedido);
            $("#error_id_lugar").text(response.responseJSON.id_lugar);
            $("#error_fecha_pedido").text(response.responseJSON.fecha_pedido);
            $("#error_fecha_ingreso").text(response.responseJSON.fecha_ingreso);
            $("#error_fecha_entrega").text(response.responseJSON.fecha_entrega);
            $("#error_id_entrega").text(response.responseJSON.id_entrega);
            $("#error_id_autoriza").text(response.responseJSON.id_autoriza);
            $("#error_id_solicitante").text(response.responseJSON.id_solicitante);
            $("#error_id_categoria_producto").text(response.responseJSON.id_categoria_producto);
            $("#error_total").text(response.responseJSON.total);
        }
    });
}

var cont = 0;
total = 0;
subtotal = [];

function Agregar_pedido() {
    id_nombre_medicamento = $("#id_nombre_medicamento").val();
    cantidad_solicitada = $("#cantidad_solicitada").val();
    cantidad_despachada = $("#cantidad_despachada").val();

    aux_id_nombre_medicamento = $("#id_nombre_medicamento option:selected").text();
    var precio = $("#id_nombre_medicamento option:selected").data("precio");
    //var precio = parseInt(precio.match(/\d+/)[0]);
    //alert(precio);

    subtotal[cont] = cantidad_despachada * precio;
    total = total + subtotal[cont];

    var fila = '<tr class ="text-center selected" id = "fila' + cont + '" >' + '<td><button type="button" class = "btn btn-danger btn-sm" onclick="eliminarFila(' + cont + ');"><i class="fa fa-times fa-2x"></i></button></dt>' + '<td><input type="hidden" name = "id_nombre_medicamento[]" value = "' + id_nombre_medicamento + '">' + aux_id_nombre_medicamento + "</td>" + '<td><input type="hidden" name = "cantidad_solicitada[]" value = "' + cantidad_solicitada + '">' + cantidad_solicitada + "</td>" + '<td><input type="hidden" name = "cantidad_despachada[]" value = "' + cantidad_despachada + '">' + cantidad_despachada + "</td>" + '<td><input type="hidden" name = "precio[]" value = "' + precio + '">' + precio + "</td>" + "</tr>";

    cont++;

    limpiar_detalles();

    $("#total").val(total);
    $("#tabla_detalles_egreso").append(fila);
}

function botonCancelar() {
    limpiar_select_detalles();
    limpiar_egreso();
    limpiar_detalles();
    $("#tabla_detalles_egreso").DataTable().clear().draw();
}

function limpiar_select_detalles() {
    selectselectidnombreproducto();
}

function limpiar_egreso() {
    $("#pedido").val("");
    $("#fecha_pedido").val("");
    $("#fecha_ingreso").val("");
    $("#fecha_entrega").val("");
    $("#total").val("");

    $("#error_pedido").text("");
    $("#error_id_lugar").text("");
    $("#error_fecha_pedido").text("");
    $("#error_fecha_ingreso").text("");
    $("#error_fecha_entrega").text("");
    $("#error_id_entrega").text("");
    $("#error_id_autoriza").text("");
    $("#error_id_solicitante").text("");
    $("#error_id_categoria_producto").text("");
    $("#error_total").text("");

    selectClinica();
    selectQuienEntrega();
    selectQuienAutoriza();
    selectsolicitantepaciente();
    selectCategoriaProducto();
    selectselectidnombreproducto();
}

function limpiar_detalles() {
    $("#cantidad_solicitada").val("");
    $("#cantidad_despachada").val("");
    selectselectidnombreproducto();
}

function eliminarFila(cont) {
    total = total - subtotal[cont];
    $("#fila" + cont).remove();
    $("#costo").val(total);

    if (cont == 0) {
        $("#costo").val("");
    }
}

function selectClinica() {
    $.ajax({url: "selectlugar", type: "get"}).done(function (resp) {
        let data = JSON.parse(JSON.stringify(resp));
        let llenardata = "";
        if (data.length > 0) {
            for (let i = 0; i < data.length; i++) {
                llenardata += "<option value='" + data[i]["id_item"] + "'>" + data[i]["descripcion"] + "</option>";
            }
            document.getElementById("id_lugar").innerHTML = llenardata;
        } else {
            llenardata += "<option value=''>No se encontraron datos</option>";
            document.getElementById("id_lugar").innerHTML = llenardata;
        }
    });
}

function selectsolicitantepaciente() {
    $("#id_lugar").on("change", function () {
        $("#id_lugar option:selected").each(function () {
            var solicitante = $(this).val();
            if (solicitante == 58) {
                $.ajax({url: "selectsolicitantepaciente", type: "get"}).done(function (resp) {
                    let data = JSON.parse(JSON.stringify(resp));
                    let llenardata = "";
                    if (data.length > 0) {
                        for (let i = 0; i < data.length; i++) {
                            llenardata += "<option value='" + data[i]["id_paciente"] + data[i]["bandera"] + "'>" + data[i]["nombres"] + " " + data[i]["apellidos"] + "</option>";
                        }
                        document.getElementById("id_solicitante").innerHTML = llenardata;
                    } else {
                        llenardata += "<option value=''>No se encontraron datos</option>";
                        document.getElementById("id_solicitante").innerHTML = llenardata;
                    }
                });
            } else {
                $.ajax({url: "selectsolicitantecolaborador", type: "get"}).done(function (resp) {
                    let data = JSON.parse(JSON.stringify(resp));
                    let llenardata = "";
                    if (data.length > 0) {
                        for (let i = 0; i < data.length; i++) {
                            llenardata += "<option value='" + data[i]["id_colaborador"] + data[i]["bandera"] + "'>" + data[i]["nombres"] + " " + data[i]["apellidos"] + "</option>";
                        }
                        document.getElementById("id_solicitante").innerHTML = llenardata;
                    } else {
                        llenardata += "<option value=''>No se encontraron datos</option>";
                        document.getElementById("id_solicitante").innerHTML = llenardata;
                    }
                });
            }
        });
    });
}

function selectQuienEntrega() {
    $.ajax({url: "selectentrega", type: "get"}).done(function (resp) {
        let data = JSON.parse(JSON.stringify(resp));
        let llenardata = "";
        if (data.length > 0) {
            for (let i = 0; i < data.length; i++) {
                llenardata += "<option value='" + data[i]["id_colaborador"] + "'>" + data[i]["nombres"] + " " + data[i]["apellidos"] + "</option>";
            }

            document.getElementById("id_entrega").innerHTML = llenardata;
        } else {
            llenardata += "<option value=''>No se encontraron datos</option>";
            document.getElementById("id_entrega").innerHTML = llenardata;
        }
    });
}

function selectQuienAutoriza() {
    $.ajax({url: "selectentrega", type: "get"}).done(function (resp) {
        let data = JSON.parse(JSON.stringify(resp));
        let llenardata = "";
        if (data.length > 0) {
            for (let i = 0; i < data.length; i++) {
                llenardata += "<option value='" + data[i]["id_colaborador"] + "'>" + data[i]["nombres"] + " " + data[i]["apellidos"] + "</option>";
            }

            document.getElementById("id_autoriza").innerHTML = llenardata;
        } else {
            llenardata += "<option value=''>No se encontraron datos</option>";
            document.getElementById("id_autoriza").innerHTML = llenardata;
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

            document.getElementById("id_categoria_producto").innerHTML = llenardata;
        } else {
            llenardata += "<option value=''>No se encontraron datos</option>";
            document.getElementById("id_categoria_producto").innerHTML = llenardata;
        }
    });
}

function selectselectidnombreproducto() {
    $("#id_categoria_producto").on("change", function () {
        $("#id_categoria_producto option:selected").each(function () {
            var categoria_producto = $(this).val();
            $.ajax({
                url: "selectselectidnombreproducto?categoria_producto=" + categoria_producto,
                type: "get"
            }).done(function (resp) {
                let data = JSON.parse(JSON.stringify(resp));
                let llenardata = "";
                if (data.length > 0) {
                    for (let i = 0; i < data.length; i++) {
                        llenardata += "<option data-precio='" + data[i]["precio_unidad"] + "' value='" + data[i]["id_producto"] + "'>" + data[i]["descripcion"] + "</option>";
                    }

                    document.getElementById("id_nombre_medicamento").innerHTML = llenardata;
                } else {
                    llenardata += "<option value=''>No se encontraron datos</option>";
                    document.getElementById("id_nombre_medicamento").innerHTML = llenardata;
                }
            });
        });
    });
}

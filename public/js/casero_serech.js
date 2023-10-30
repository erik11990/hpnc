function limpiarCamposRegister() {
    $("#name").val("");
    $("#email").val("");
    $("#password").val("");
    $("#passwordConfirm").val("");
}

function cs() {
    var formData = $("#csssss").serialize();
    $.ajax({
        data: formData,
        url: "crearusuario/store",
        type: "POST",
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            limpiarCamposRegister();
            $("#guardado_exitoso").show();
            $("#guardado_exitoso").text(response.hola);
            $("#guardado_exitoso").fadeOut(3000, function () {
                $(this).remove();
            });
            window.location = "/dashboard";
        },
        error: function (response) {
            alert(response);

            /* if ($("#error_id_forma").val() != response.responseJSON.id_forma) {
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
        */
        },
    });
}

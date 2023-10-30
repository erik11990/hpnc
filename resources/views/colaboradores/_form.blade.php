<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Formulario de colaboradores</h3>
                </div>
                <form id="form_colaborador">
                    <div class="card-body">
                        <input type="hidden" id="id_colaborador" name="id_colaborador">
                        <input type="hidden" id="id_persona" name="id_persona">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="buscar_persona_x_dpi">Buscar por DPI</label>
                                    <input type="text" class="form-control" id="buscar_persona_x_dpi"
                                        placeholder="Buscar por DPI">
                                    <p class="text-red" id="error_buscar_persona_x_dpi"></p>
                                </div>
                            </div>
                            <div id="generales_persona" class="generales_persona col-md-4">
                                <div class="form-group">
                                    <label>Nombres y apellidos</label><br>
                                    <div class="row">
                                        <p id="nombre_persona"></p>&nbsp;
                                        <p id="apellido_persona"></p>
                                    </div>
                                </div>
                            </div>
                            <div id="generales_dpi" class="generales_dpi col-md-4">
                                <div class="form-group">
                                    <label for="dpi_persona">DPI</label><br>
                                    <p id="dpi_persona"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="id_tipo_colabordor">Tipo de colaborador</label>
                                        <select class="form-control" id="id_tipo_colabordor" name="id_tipo_colabordor">
                                        </select>
                                        <p class="text-red" id="error_id_tipo_colaborador"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="btn_guardar_colaborador" type="button" class="btn btn-primary"
                                onclick="Registrar_colaborador()">Guardar</button>
                            <button id="btn_actualizar_colaborador" type="button" class="btn btn-info"
                                onclick="Actualizar_colaborador()">Actualizar</button>
                            <button type="button" class="btn btn-danger"
                                onclick="limpiarFormColaborador()">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    cargar_select_tipo_de_colaborador();
    $("#generales_persona").hide();
    $("#generales_dpi").hide();
    $("#btn_actualizar_colaborador").hide();

    $(document).ready(function() {
        $("#form_colaborador").keypress(function(e) {
            if (e.which == 13) {
                return false;
            }
        });
    });
</script>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Formulario de pacientes</h3>
                </div>
                <form id="form_paciente">
                    <div class="card-body">
                        <input type="hidden" id="id_paciente" name="id_paciente">
                        <input type="hidden" id="id_persona" name="id_persona">
                        <div class="row">
                            <div class="fixed-top d-flex justify-content-center p-3" style="z-index: 1050;">
                                <div class="toast" role="alert" aria-live="assertive" aria-atomic="true"
                                    data-delay="5000">
                                    <div class="toast-header bg-danger text-white">
                                        <strong class="mr-auto">¡Alerta!</strong>
                                        <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast"
                                            aria-label="Cerrar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div id="dpi_requerido" class="toast-body">

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="buscar_persona_x_dpi">Buscar por DPI</label>
                                    <input type="text" class="form-control" id="buscar_persona_x_dpi"
                                        placeholder="Buscar por DPI">
                                    <p class="text-red" id="error_buscar_persona_x_dpi"></p>
                                </div>
                            </div>
                            <div class="col-md-1" style="margin-top: 2rem;">
                                <div class="form-group">
                                    <button onclick="buscar_persona()" type="button" class="btn btn-info"><i
                                            class="fas fa-search"></i></button>
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
                                        <label for="id_tipo_paciente">Tipo de paciente</label>
                                        <select class="form-control" id="id_tipo_paciente" name="id_tipo_paciente">
                                        </select>
                                        <p class="text-red" id="error_id_tipo_paciente"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="btn_guardar_paciente" type="button" class="btn btn-primary"
                                onclick="Registrar_paciente()">Guardar</button>
                            <button id="btn_actualizar_paciente" type="button" class="btn btn-info"
                                onclick="Actualizar_paciente()">Actualizar</button>
                            <button type="button" class="btn btn-danger"
                                onclick="limpiarFormPaciente()">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    cargar_select_tipo_de_paciente();
    $("#generales_persona").hide();
    $("#generales_dpi").hide();
    $("#btn_actualizar_paciente").hide();

    $(document).ready(function() {
        $("#form_paciente").keypress(function(e) {
            if (e.which == 13) {
                return false;
            }
        });
    });
</script>

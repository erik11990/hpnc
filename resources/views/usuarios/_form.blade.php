<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Formulario de afiliados</h3>
                </div>
                <form id="form_persona">
                    <div class="card-body">
                        <input type="hidden" id="id_persona" name="id_persona">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nombres">Nombres</label>
                                    <input type="text" class="form-control" id="nombres" name="nombres"
                                        placeholder="Nombres">
                                    <p class="text-red" id="error_nombres"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="apellidos">Apellidos</label>
                                    <input type="text" class="form-control" id="apellidos" name="apellidos"
                                        placeholder="Apellidos">
                                    <p class="text-red" id="error_apellidos"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fecha_nacimiento">Fecha de nacimiento</label>
                                    <input type="date" class="form-control" id="fecha_nacimiento"
                                        name="fecha_nacimiento" placeholder="Fecha de nacimiento">
                                    <p class="text-red" id="error_fecha_nacimiento"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dpi">DPI</label>
                                    <input type="text" class="form-control" id="dpi" name="dpi"
                                        placeholder="DPI">
                                    <p class="text-red" id="error_dpi"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="telefono">Tel&eacute;fono</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono"
                                        placeholder="Teléfono">
                                    <p class="text-red" id="error_telefono"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="id_departamento_residencia">Departamento</label>
                                        <select class="form-control" id="id_departamento_residencia"
                                            name="id_departamento_residencia">
                                        </select>
                                        <p class="text-red" id="error_id_departamento_residencia"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="id_municipio_residencia">Municipio</label>
                                        <select class="form-control" id="id_municipio_residencia"
                                            name="id_municipio_residencia">
                                        </select>
                                        <p class="text-red" id="error_id_municipio_residencia"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="direccion_residencia">Dirección de residencia</label>
                                    <input type="text" class="form-control" id="direccion_residencia"
                                        name="direccion_residencia" placeholder="Dirección de residencia">
                                    <p class="text-red" id="error_direccion_residencia"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="id_estado_civil">Estado civil</label>
                                        <select class="form-control" id="id_estado_civil" name="id_estado_civil">
                                        </select>
                                        <p class="text-red" id="error_id_estado_civil"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nombre_padre">Nombre del padre</label>
                                    <input type="text" class="form-control" id="nombre_padre" name="nombre_padre"
                                        placeholder="Nombre del padre">
                                    <p class="text-red" id="error_nombre_padre"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nombre_madre">Nombre de la madre</label>
                                    <input type="text" class="form-control" id="nombre_madre" name="nombre_madre"
                                        placeholder="Nombre de la madre">
                                    <p class="text-red" id="error_nombre_madre"></p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="btn_guardar_usuario" type="button" class="btn btn-primary"
                                onclick="Registrar_usuario()">Guardar</button>
                            <button id="btn_actualizar_usuario" type="button" class="btn btn-info"
                                onclick="Actualizar_usuario()">Actualizar</button>
                            <button type="button" class="btn btn-danger"
                                onclick="limpiarFormUsuario()">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    cargar_select_depatamento();
    cargar_select_municipio();
    $(".editarUsuario").on("click", function() {
        cargar_select_municipio_editar();
    });
    cargar_select_estado_civil();
</script>

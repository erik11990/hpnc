<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Formulario de ítems</h3>
                </div>
                <form id="form_item">
                    <div class="card-body">
                        <input type="hidden" id="id_item" name="id_item">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="id_categoria">Categoría</label>
                                        <select class="form-control" id="id_categoria" name="id_categoria">
                                        </select>
                                        <p class="text-red" id="error_id_categoria"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <input type="text" class="form-control" id="descripcion" name="descripcion"
                                        placeholder="Descripción">
                                    <p class="text-red" id="error_descripcion"></p>

                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="btn_guardar_item" type="button" class="btn btn-primary"
                                onclick="Registrar_item()">Guardar</button>
                            <button id="btn_actualizar_item" type="button" class="btn btn-info"
                                onclick="Actualizar_item()">Actualizar</button>
                            <button type="button" class="btn btn-danger" onclick="limpiarFormItem()">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    cargar_select_cat();
</script>

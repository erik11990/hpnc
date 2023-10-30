<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Formulario de categorías</h3>
                </div>
                <form id="form_categoria">
                    <div class="card-body">
                        <input type="hidden" id="id_categoria" name="id_categoria">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <input type="text" class="form-control" id="descripcion" name="descripcion"
                                        placeholder="Descripción">
                                    <p class="text-red" id="error_descripcion"></p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="btn_guardar_categoria" type="button" class="btn btn-primary"
                                onclick="Registrar_categoria()">Guardar</button>
                            <button id="btn_actualizar_categoria" type="button" class="btn btn-info"
                                onclick="Actualizar_categoria()">Actualizar</button>
                            <button type="button" class="btn btn-danger"
                                onclick="limpiarFormCategoria()">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

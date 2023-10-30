<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Formulario de productos</h3>
                </div>
                <form id="form_productos">
                    <div class="card-body">
                        <input type="hidden" id="id_producto" name="id_producto">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="id_categoria_mp">Categoría</label>
                                        <select class="form-control" id="id_categoria_mp" name="id_categoria_mp">
                                        </select>
                                        <p class="text-red" id="error_id_categoria_mp"></p>
                                    </div>
                                </div>
                            </div>
                            <div id="oculatar_div_af" class="col-md-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="id_accion_farmacologica">Acción farmacológica</label>
                                        <select class="form-control" id="id_accion_farmacologica"
                                            name="id_accion_farmacologica">
                                        </select>
                                        <p class="text-red" id="error_id_accion_farmacologica"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <input type="text" class="form-control" id="descripcion" name="descripcion"
                                        placeholder="Descripcion">
                                    <p class="text-red" id="error_descripcion"></p>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="stock">Stock</label>
                                    <input type="text" class="form-control" id="stock" name="stock"
                                        placeholder="Stock" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="btn_guardar_producto" type="button" class="btn btn-primary"
                                onclick="Registrar_producto()">Guardar</button>
                            <button id="btn_actualizar_producto" type="button" class="btn btn-info"
                                onclick="Actualizar_producto()">Actualizar</button>
                            <button type="button" class="btn btn-danger"
                                onclick="limpiarFormProducto()">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    selectCategoriaProducto();
    cargar_select_AccionFarmacologica();
    $("#btn_actualizar_producto").hide();
    $("#oculatar_div_af").hide();
</script>

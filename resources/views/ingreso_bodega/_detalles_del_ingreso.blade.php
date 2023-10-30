<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="id_accion_farmacologica">Acción farmacológica:</label>
            <select class="text-blue form-control" id="id_accion_farmacologica">
            </select>
            <p class="text-red" id="error_id_accion_farmacologica"></p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="id_nombre_producto">Producto:</label>
            <select class="text-blue form-control" id="id_nombre_producto">
            </select>
            <p class="text-red" id="error_id_nombre_producto"></p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="id_laboratorio">Laboratorio:</label>
            <select class="text-blue form-control" id="id_laboratorio">
            </select>
            <p class="text-red" id="error_id_laboratorio"></p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="concentracion">Concentracion:</label>
            <input type="text" class="text-green form-control" id="concentracion" placeholder="Concentracion">
            <p class="text-red" id="error_concentracion"></p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="id_presentacion_unidad_de_medida">Presentación/Unidad de medida:</label>
            <select class="text-blue form-control" id="id_presentacion_unidad_de_medida">
            </select>
            <p class="text-red" id="error_id_presentacion_unidad_de_medida"></p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="id_marca">Marca:</label>
            <select class="text-blue form-control" id="id_marca">
            </select>
            <p class="text-red" id="error_id_marca"></p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="lote">Lote:</label>
            <input type="text" class="text-green form-control" id="lote" placeholder="Lote">
            <p class="text-red" id="error_concentracion"></p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="fecha_vencimiento">Fecha de vencimiento:</label>
            <input type="date" class="text-green form-control" id="fecha_vencimiento"
                placeholder="Fecha de vencimiento">
            <p class="text-red" id="error_fecha_vencimiento"></p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="cantidad">Cantidad:</label>
            <input type="text" class="text-green form-control" id="cantidad" placeholder="Cantidad">
            <p class="text-red" id="error_cantidad"></p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="precio_unidad">Precio unitario:</label>
            <input type="text" class="text-green form-control" id="precio_unidad" placeholder="Precio unitario">
            <p class="text-red" id="error_precio_unidad"></p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="id_codigo_gasto_renglon">Código/Gasto renglón:</label>
            <select class="text-blue form-control" id="id_codigo_gasto_renglon">
            </select>
            <p class="text-red" id="error_id_codigo_gasto_renglon"></p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="orden_cp_y_p_numero">Orden CP y P numero:</label>
            <input type="text" class="text-green form-control" id="orden_cp_y_p_numero"
                placeholder="Orden CP y P numero">
            <p class="text-red" id="error_orden_cp_y_p_numero"></p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="folio_libro_inventario">Folio libro inventario:</label>
            <input type="text" class="text-green form-control" id="folio_libro_inventario"
                placeholder="Folio libro inventario">
            <p class="text-red" id="error_folio_libro_inventario"></p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="nomenclatura_de_cuentas">Nomenclatura de cuentas:</label>
            <input type="text" class="text-green form-control" id="nomenclatura_de_cuentas"
                placeholder="Nomenclatura de cuentas">
            <p class="text-red" id="error_nomenclatura_de_cuentas"></p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="folio_almacen">Folio almacen:</label>
            <input type="text" class="text-green form-control" id="folio_almacen" placeholder="Folio almacen">
            <p class="text-red" id="error_folio_almacen"></p>
        </div>
    </div>
</div>
<div class="card-footer">
    <button type="button" class="btn btn-success" onclick="Agregar_prodcuto()">Agregar
        producto</button>
</div>

<script>
    selectidaccionfarmacologica();
    selectselectidnombreproducto();
    selectidlaboratorio();
    selectidpresentacionunidaddemedida();
    selectidmarca();
    selectidcodigogastorenglon();
</script>

<script>
    $(document).ready(function() {
        $("#tabla_detalles").DataTable({
            scrollX: true,
            bInfo: false,
            bLengthChange: false,
            bFilter: false,
            bPaginate: false,
            bSort: false,
            oLanguage: {
                sZeroRecords: "",
                sEmptyTable: ""
            }
        });
    });
</script>

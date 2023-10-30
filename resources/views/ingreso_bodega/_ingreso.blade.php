<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="id_forma">Forma</label>
            <select class="text-green form-control" id="id_forma" name="id_forma">
            </select>
            <p class="text-red" id="error_id_forma"></p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="id_serie">Serie</label>
            <select class="text-green form-control" id="id_serie" name="id_serie">
            </select>
            <p class="text-red" id="error_id_serie"></p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="numero">No.</label>
            <input type="text" class="text-green form-control" id="numero" name="numero" placeholder="No.">
            <p class="text-red" id="error_numero"></p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="factura_serie">Factura serie</label>
            <input type="text" class="text-green form-control" id="factura_serie" name="factura_serie"
                placeholder="Factura serie">
            <p class="text-red" id="error_factura_serie"></p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="numero_dte">Número de DTE:</label>
            <input type="text" class="text-green form-control" id="numero_dte" name="numero_dte"
                placeholder="Número de DTE">
            <p class="text-red" id="error_numero_dte"></p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="fecha">Fecha:</label>
            <input type="date" class="text-green form-control" id="fecha" name="fecha" placeholder="Fecha">
            <p class="text-red" id="error_fecha"></p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="id_proveedor">Proveedor:</label>
            <select class="text-green form-control" id="id_proveedor" name="id_proveedor">
            </select>
            <p class="text-red" id="error_id_proveedor"></p>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="id_codigo">Código:</label>
            <select class="text-green form-control" id="id_codigo" name="id_codigo">
            </select>
            <p class="text-red" id="error_id_codigo"></p>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="id_libro">Libro:</label>
            <select class="text-green form-control" id="id_libro" name="id_libro">
            </select>
            <p class="text-red" id="error_id_libro"></p>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="numero_libro">No. Libro:</label>
            <input type="text" class="text-green form-control" id="numero_libro" name="numero_libro"
                placeholder="No. Libro">
            <p class="text-red" id="error_numero_libro"></p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="id_categoria_producto">Categoria del produto:</label>
            <select class="text-red form-control" id="id_categoria_producto" name="id_categoria_producto">
            </select>
            <p class="text-red" id="error_id_categoria_producto"></p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="id_dependencia">Dependencia:</label>
            <select class="text-green form-control" id="id_dependencia" name="id_dependencia">
            </select>
            <p class="text-red" id="error_id_dependencia"></p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="id_programa">Programa:</label>
            <select class="text-green form-control" id="id_programa" name="id_programa">
            </select>
            <p class="text-red" id="error_id_programa"></p>
        </div>
    </div>
    <div class="col-md-10">
        <div class="form-group">
            <label for="observaciones">Observaciones:</label>
            <textarea class="text-green form-control" id="observaciones" name="observaciones" placeholder="Observaciones"
                rows="1"></textarea>
            <p class="text-red" id="error_observaciones"></p>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="costo">Costo:</label>
            <input type="number" class="text-green form-control" id="costo" name="costo" placeholder="Costo" readonly>
            <p class="text-red" id="error_costo"></p>
        </div>
    </div>
</div>

<script>
    selectForma();
    selectSerie();
    selectProveedor();
    selectCodigo();
    selectLibro();
    selectCategoriaProducto();
    selectDependencia();
    selectPrograma();
</script>

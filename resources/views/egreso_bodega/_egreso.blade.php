<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label for="pedido">Pedido</label>
            <input type="text" class="text-green form-control" id="pedido" name="pedido" placeholder="Pedido">
            <p class="text-red" id="error_pedido"></p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="id_lugar">Quien solicita:</label>
            <select class="text-green form-control" id="id_lugar" name="id_lugar">
            </select>
            <p class="text-red" id="error_id_lugar"></p>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="fecha_pedido">Fecha pedido:</label>
            <input type="date" class="text-green form-control" id="fecha_pedido" name="fecha_pedido"
                placeholder="Fecha pedido">
            <p class="text-red" id="error_fecha_pedido"></p>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="fecha_ingreso">Fecha ingreso:</label>
            <input type="date" class="text-green form-control" id="fecha_ingreso" name="fecha_ingreso"
                placeholder="Fecha ingreso">
            <p class="text-red" id="error_fecha_ingreso"></p>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="fecha_entrega">Fecha entrega:</label>
            <input type="date" class="text-green form-control" id="fecha_entrega" name="fecha_entrega"
                placeholder="Fecha entrega">
            <p class="text-red" id="error_fecha_entrega"></p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="id_entrega">Quién entrega:</label>
            <select class="text-green form-control" id="id_entrega" name="id_entrega">
            </select>
            <p class="text-red" id="error_id_entrega"></p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="id_autoriza">Quién autoriza:</label>
            <select class="text-green form-control" id="id_autoriza" name="id_autoriza">
            </select>
            <p class="text-red" id="error_id_autoriza"></p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="id_categoria_producto">Nombre del solicitante:</label>
            <select class="text-red form-control" id="id_solicitante" name="id_solicitante">
            </select>
            <p class="text-red" id="error_id_solicitante"></p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="id_categoria_producto">Categoria del producto:</label>
            <select class="text-green form-control" id="id_categoria_producto" name="id_categoria_producto">
            </select>
            <p class="text-red" id="error_id_categoria_producto"></p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="total">Total</label>
            <input type="text" class="text-green form-control" id="total" name="total" placeholder="Total" readonly>
            <p class="text-red" id="error_total"></p>
        </div>
    </div>
</div>

<script>
selectClinica();
selectQuienEntrega();
selectQuienAutoriza();
selectsolicitantepaciente();
selectCategoriaProducto();
</script>

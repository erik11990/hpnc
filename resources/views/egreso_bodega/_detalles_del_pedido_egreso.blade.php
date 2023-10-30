<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="id_nombre_medicamento">Medicamento:</label>
            <select class="text-blue form-control" id="id_nombre_medicamento">
            </select>
            <p class="text-red" id="error_id_nombre_medicamento"></p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="cantidad_solicitada">Cantidad solicitada:</label>
            <input type="text" class="text-green form-control" id="cantidad_solicitada" placeholder="Cantidad solicitada">
            <p class="text-red" id="error_cantidad_solicitada"></p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="cantidad_despachada">Cantidad despachada:</label>
            <input type="text" class="text-green form-control" id="cantidad_despachada" placeholder="Cantidad despachada">
            <p class="text-red" id="error_cantidad_despachada"></p>
        </div>
    </div>
</div>
<div class="card-footer">
    <button type="button" class="btn btn-success" onclick="Agregar_pedido()">Agregar
        producto</button>
</div>

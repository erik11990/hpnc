<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Formulario de pedido/egreso</h3>
                </div>
                <form id="form_egreso">
                    <div class="card-body">
                        <strong><span class="text-blue">Pedido/Egreso</span></strong><br>
                        @include('egreso_bodega._egreso')
                        <strong><span class="text-blue">Detalles del Pedido/Egreso</span></strong><br>
                        @include('egreso_bodega._detalles_del_pedido_egreso')
                        @include('egreso_bodega._tabla_detalles_pedido_egreso')

                        <div class="card-footer">
                            <button id="btn_guardar_pedido_egreso" type="button" class="btn btn-primary"
                                onclick="Registrar_egreso()">Guardar</button>
                            <button type="button" class="btn btn-danger"
                                onclick="botonCancelar()">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

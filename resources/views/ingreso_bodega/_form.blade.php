<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Formulario de ingreso a bodega</h3>
                </div>
                <form id="form_ingreso">
                    <div class="card-body">
                        <strong><span class="text-blue">Ingreso</span></strong><br>
                        @include('ingreso_bodega._ingreso')
                        <strong><span class="text-blue">Detalles del ingreso</span></strong><br>
                        @include('ingreso_bodega._detalles_del_ingreso')
                        @include('ingreso_bodega._tabla_detalles')

                        <div class="card-footer">
                            <button id="btn_guardar_pedido" type="button" class="btn btn-primary"
                                onclick="Registrar_ingreso()">Guardar</button>
                            <button type="button" class="btn btn-danger"
                                onclick="botonCancelar()">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Listado de pedidos/egresos</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <table id="tabla_index_egreso" class="data-table display nowrap" cellspacing="0"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Acciones</th>
                                        <th>Pedido</th>
                                        <th>Quien solicita</th>
                                        <th>Fecha pedido</th>
                                        <th>Fecha ingreso</th>
                                        <th>Fecha entrega</th>
                                        <th>Quién entrega</th>
                                        <th>Quién autoriza</th>
                                        <th>Nombre del solicitante paciente</th>
                                        <th>Nombre del solicitante colaborador</th>
                                        <th>Categoría del producto</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Acciones</th>
                                        <th>Pedido</th>
                                        <th>Quien solicita</th>
                                        <th>Fecha pedido</th>
                                        <th>Fecha ingreso</th>
                                        <th>Fecha entrega</th>
                                        <th>Quién entrega</th>
                                        <th>Quién autoriza</th>
                                        <th>Nombre del solicitante paciente</th>
                                        <th>Nombre del solicitante colaborador</th>
                                        <th>Categoría del producto</th>
                                        <th>Total</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    /* para reinicializar el data table */
    $(document).ready(function() {
        $("#tabla_index_egreso").DataTable({
            retrieve: true,
            paging: false,
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
<script>
    list_egreso_index_simple();
</script>

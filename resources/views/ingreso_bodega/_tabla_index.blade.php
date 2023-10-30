<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Listado de ingresos</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <table id="tabla_index" class="data-table display nowrap" cellspacing="0" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Acciones</th>
                                        <th>Forma</th>
                                        <th>Serie</th>
                                        <th>Numero</th>
                                        <th>Factura serie</th>
                                        <th>Número dte</th>
                                        <th>Fecha</th>
                                        <th>Proveedor</th>
                                        <th>Código</th>
                                        <th>Líbro</th>
                                        <th>Número libro</th>
                                        <th>Categoría producto</th>
                                        <th>Dependencia</th>
                                        <th>Programa</th>
                                        <th>Observaciones</th>
                                        <th>Costo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Acciones</th>
                                        <th>Forma</th>
                                        <th>Serie</th>
                                        <th>Numero</th>
                                        <th>Factura serie</th>
                                        <th>Número dte</th>
                                        <th>Fecha</th>
                                        <th>Proveedor</th>
                                        <th>Código</th>
                                        <th>Líbro</th>
                                        <th>Número libro</th>
                                        <th>Categoría producto</th>
                                        <th>Dependencia</th>
                                        <th>Programa</th>
                                        <th>Observaciones</th>
                                        <th>Costo</th>
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
    list_index_simple();
</script>

<script>
    /* para reinicializar el data table */
    $(document).ready(function() {
        $("#tabla_index").DataTable({
            retrieve: true,
            paging: false
        });
    });
</script>

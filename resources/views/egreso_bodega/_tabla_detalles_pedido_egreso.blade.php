<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-success">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <table id="tabla_detalles_egreso" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Acci&oacute;n</th>
                                        <th>Medicamento</th>
                                        <th>Cantidad solicitada</th>
                                        <th>Cantidad despachada</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                    <th>Acci&oacute;n</th>
                                        <th>Medicamento</th>
                                        <th>Cantidad solicitada</th>
                                        <th>Cantidad despachada</th>
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
    $(document).ready(function() {
        $("#tabla_detalles_egreso").DataTable({
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
    selectselectidnombreproducto();
</script>
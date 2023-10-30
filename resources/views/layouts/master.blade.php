<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>HPNC | Dashboard</title>
    @include('layouts.css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo"
                height="60" width="60">
        </div>

        @include('layouts.header')

        @include('layouts.sidebar')

        @include('layouts.dashboard')

        @include('layouts.footer')


        <aside class="control-sidebar control-sidebar-dark">

        </aside>

    </div>

    @include('layouts.script')

    <script>
        function cargar_contenido(id, vista) {
            $("#" + id).load(vista);
        }

        var idioma_espanol = {
            select: {
                rows: "%d fila seleccionada"
            },
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ning&uacute;n dato disponible en esta tabla",
            "sInfo": "Registros del (_START_ al _END_) total de _TOTAL_ registros",
            "sInfoEmpty": "Registros del (0 al 0) total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "<b>No se encontraron datos</b>",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }

        afiliados();
        pacientes();
        colaboradores();
        usuarios();

        function afiliados() {
            $.ajax({
                url: "afiliadostotal",
                type: "get",
                dataType: "json",
                success: function(response) {
                    var dato = response;
                    $('#totalAfiliados').text(dato);
                },
                error: function(response) {}
            });
        }

        function pacientes() {
            $.ajax({
                url: "pacientestotal",
                type: "get",
                dataType: "json",
                success: function(response) {
                    var dato = response;
                    $('#totalPacintes').text(dato);
                },
                error: function(response) {}
            });
        }

        function colaboradores() {
            $.ajax({
                url: "colaboradorestotal",
                type: "get",
                dataType: "json",
                success: function(response) {
                    var dato = response;
                    $('#totalColaboradores').text(dato);
                },
                error: function(response) {}
            });
        }

        function usuarios() {
            $.ajax({
                url: "usuariostotal",
                type: "get",
                dataType: "json",
                success: function(response) {
                    var dato = response;
                    $('#totalUsuarios').text(dato);
                },
                error: function(response) {}
            });
        }

        var rol_session = $('#rol_session').val();

        if (rol_session == "2") {
            cargar_contenido('contenido_principal', 'bodega');
        } else if (rol_session == "3") {
            cargar_contenido('contenido_principal', 'egresobodega');
        }
    </script>
</body>

</html>

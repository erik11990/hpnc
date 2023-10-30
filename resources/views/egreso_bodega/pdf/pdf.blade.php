<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>SGSP-PNC</title>
    <style>
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        .place {
            text-align: right;
            margin-top: 30px;
        }

        .bank {
            width: 100%;
            height: 70%;
            background: #ffff;
            border: none;
            font-size: 14px;
            font-family: Arial;
            color: black;
            overflow: hidden;
            resize: none;
        }

        a {
            color: #5D6975;
            text-decoration: underline;
        }

        body {
            position: relative;
            width: 19cm;
            height: 26cm;
            margin: 0 auto;
            color: black;
            background: #FFFFFF;
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        header {
            padding: 10px 0;
        }

        #logo {
            float: left;
            margin-bottom: 10px;
        }

        #logo img {
            height: 80px;
        }

        h1 {
            border-top: 1px solid #5D6975;
            border-bottom: 1px solid #5D6975;
            color: black;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: left;
            margin: 0 0 20px 0;
        }

        h2 {
            color: black;
            font-size: 1.4em;
            line-height: 1.4em;
            font-weight: normal;
            margin: 10px 10px 20px 0;
            text-align: center;
        }

        .inv {}

        .users {
            display: block;
            margin-right: 30px;
            margin-left: 30px;
        }

        .seller {
            float: left;
            font-size: 16px;
            margin-bottom: 30px;
        }

        .company {
            float: right;
            font-size: 16px;
            margin-bottom: 30px;
        }

        #seller div,
        #company div {
            white-space: nowrap;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table th,
        table td {
            text-align: right;
        }

        table th {
            padding: 5px 5px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
        }

        table .service,
        table .desc {
            text-align: left;
        }

        table td {
            padding: 5px;
            text-align: right;
        }

        table td.service,
        table td.desc {
            vertical-align: top;
        }

        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.2em;
        }

        table td.grand {
            border-top: 1px solid #5D6975;
            ;
        }

        footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
        }

        .total {
            font-family: Arial;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <header class="clearfix">
        <div>
            <div class="row" style="text-align: right">
                Pedido # {{ $egreso[0]->pedido }}
            </div>
            <div class="row">
                <strong>{{ $mensaje }}</strong>
            </div>
            <table>
                <tbody>
                    <tr>
                        <td colspan="8" style="text-align: left; border: 1px solid #0e0e0e;">
                            <strong>
                                QUIÉN SOLICITA
                            </strong>
                            {{ $egreso[0]->descripcion }}
                            <strong>
                                FECHA PEDIDO
                            </strong>
                            {{ $egreso[0]->fecha_pedido }}
                            <strong>
                                FECHA INGRESO
                            </strong>
                            {{ $egreso[0]->fecha_ingreso }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8" style="text-align: left; border: 1px solid #0e0e0e;">
                            <strong>
                                FECHA DE ENTREGA
                            </strong>
                            {{ $egreso[0]->fecha_entrega }}
                            <strong>
                                QUIÉN ENTREGA
                            </strong>
                            {{ $egreso[0]->nombres_entrega }}
                            {{ $egreso[0]->apellidos_entrega }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8" style="text-align: left; border: 1px solid #0e0e0e;">
                            <strong>
                                QUIÉN AUTORIZA
                            </strong>
                            {{ $egreso[0]->nombres_autoriza }}
                            {{ $egreso[0]->apellidos_autoriza }}
                            <strong>
                                NOMBRE DEL PACIENTE SOLICITANTE
                            </strong>
                            @if ($egreso[0]->nnombres_paciente == null && $egreso[0]->apellidos_paciente == null)
                                No hay solicitante
                            @else
                                {{ $egreso[0]->nombres_paciente }}
                                {{ $egreso[0]->apellidos_paciente }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8" style="text-align: left; border: 1px solid #0e0e0e;">
                            <strong>
                                NOMBRE DEL COLABORADOR SOLICITANTE
                            </strong>
                            @if ($egreso[0]->nombres_colaborador == null && $egreso[0]->apellidos_colaborador == null)
                                No hay solicitante
                            @else
                                {{ $egreso[0]->nombres_colaborador }}
                                {{ $egreso[0]->apellidos_colaborador }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8" style="text-align: left; border: 1px solid #0e0e0e;">
                            <strong>
                                CATEGORÍA DEL PRODUCTO
                            </strong>
                            {{ $egreso[0]->descripcion_cat }}
                            <strong>
                                TOTAL Q.
                            </strong>
                            {{ $egreso[0]->total }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div>
            <table>
                <tbody>
                    @foreach ($egreso_detalles as $key => $id)
                        <tr>
                            <td colspan="4" style="text-align: right; border: 1px solid #0e0e0e;">
                                <br><strong>Producto: </strong>
                                <br><strong>Cantidad solicitada: </strong>
                                <br><strong>Cantidad despachada: </strong>
                                <br><strong>Precio: </strong>
                            </td>
                            <td colspan="4" style="text-align: left; border: 1px solid #0e0e0e;">
                                <br>{{ $id['producto'] }}
                                <br>{{ $id['cantidad_solicitada'] }}
                                <br>{{ $id['cantidad_despachada'] }}
                                <br>{{ $id['precio'] }}
                            </td>
                        <tr>
                            <td colspan="8">

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </header>
    <footer>
        SUBDIRECCIÓN GENERAL DE SALUD POLICIAL
    </footer>
</body>

</html>

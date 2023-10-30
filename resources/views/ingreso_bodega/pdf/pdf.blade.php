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

        #notices .notice {
            color: #5D6975;
            font-size: 1.2em;
            margin-bottom: 20px;
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
                FORMA {{ $ingreso[0]->id_forma }} <br>
                SERIE {{ $ingreso[0]->id_serie }} <br>
                NO. {{ $ingreso[0]->numero }}
            </div>
            <div class="row">
                <strong>{{ $mensaje }}</strong>
            </div>
            <table>
                <tbody>
                    <tr>
                        <td colspan="8" style="text-align: left; border: 1px solid #0e0e0e;">
                            <strong>
                                DEPENDENCIA
                            </strong>
                            {{ $ingreso[0]->id_dependencia }}
                            <strong>
                                NÚMERO
                            </strong>
                            FACTURA {{ $ingreso[0]->factura_serie }}
                            No. {{ $ingreso[0]->numero_dte }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8" style="text-align: left; border: 1px solid #0e0e0e;">
                            <strong>
                                PROGRAMA
                            </strong>
                            {{ $ingreso[0]->id_programa }}
                            <strong>
                                FECHA
                            </strong>
                            {{ $ingreso[0]->fecha }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8" style="text-align: left; border: 1px solid #0e0e0e;">
                            <strong>
                                PROVEEDOR
                            </strong>
                            {{ $ingreso[0]->id_proveedor }}
                            <strong>
                                ORDEN DE C. Y P. No.
                            </strong>
                            {{ $ingreso[0]->id_codigo }}

                            <strong>
                                LIBRO
                            </strong>
                            {{ $ingreso[0]->id_libro }}
                            <strong>
                                No. LIBRO
                            </strong>
                            {{ $ingreso[0]->numero_libro }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: left; border: 1px solid #0e0e0e;">
                            <strong>
                                CATEGORIA DE PRODUCTO
                            </strong>
                            {{ $ingreso[0]->id_categoria_producto }}
                        </td>
                        <td colspan="3" style="text-align: left; border: 1px solid #0e0e0e;">
                            <strong>
                                COSTO
                            </strong>
                            {{ $ingreso[0]->costo }}
                        </td>
                        <td colspan="2" style="text-align: left; border: 1px solid #0e0e0e;">
                            <strong>
                                OBSERVACIONES
                            </strong>
                            {{ $ingreso[0]->observaciones }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div>
            <table>
                <tbody>
                    @foreach ($ingreso_detalles as $key => $id)
                        <tr>
                            <td colspan="4" style="text-align: right; border: 1px solid #0e0e0e;">
                                <strong style="color: blue;">Registro: </strong>
                                <br><strong>Acción farmacologica: </strong>
                                <br><strong>Nombre del producto: </strong>
                                <br><strong>Laboratorio: </strong>
                                <br><strong>Concentración: </strong>
                                <br><strong>Presentacion/Unidad de medida: </strong>
                                <br><strong>Marca: </strong>
                                <br><strong>Lote: </strong>
                                <br><strong>Fecha vencimiento: </strong>
                                <br><strong>Cantidad: </strong>
                                <br><strong>Precio unidad: </strong>
                                <br><strong>Codigo/gasto renglón: </strong>
                                <br><strong>Orden cp y p número: </strong>
                                <br><strong>Folio/libro inventario: </strong>
                                <br><strong>Nomenclatura de cuentas: </strong>
                                <br><strong>Folio almacen: </strong>
                                <br><strong>Sub_total: </strong>
                            </td>
                            <td colspan="4" style="text-align: left; border: 1px solid #0e0e0e;">
                                <strong style="color: blue;"> {{ $key }} </strong>
                                <br>{{ $id['id_accion_farmacologica'] }}
                                <br>{{ $id['id_nombre_producto'] }}
                                <br>{{ $id['id_laboratorio'] }}
                                <br>{{ $id['concentracion'] }}
                                <br>{{ $id['id_presentacion_unidad_de_medida'] }}
                                <br>{{ $id['id_marca'] }}
                                <br>{{ $id['lote'] }}
                                <br>{{ $id['fecha_vencimiento'] }}
                                <br>{{ $id['cantidad'] }}
                                <br>{{ $id['precio_unidad'] }}
                                <br>{{ $id['id_codigo_gasto_renglon'] }}
                                <br>{{ $id['orden_cp_y_p_numero'] }}
                                <br>{{ $id['folio_libro_inventario'] }}
                                <br>{{ $id['nomenclatura_de_cuentas'] }}
                                <br>{{ $id['folio_almacen'] }}
                                <br>{{ $id['precio_unidad'] * $id['cantidad'] }}
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

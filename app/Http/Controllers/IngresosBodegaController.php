<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Ingreso;
use App\Models\IngresoDetalle;
use App\Models\Item;
use App\Models\Producto;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PDF;

class IngresosBodegaController extends Controller
{
    public function listarIngresos(Request $request)
    {
        $data = Ingreso::join('item as it_id_forma', 'it_id_forma.id_item', 'ingreso_bodega.id_forma')
            ->join('item as it_id_serie', 'it_id_serie.id_item', 'ingreso_bodega.id_serie')
            ->join('item as it_id_proveedor', 'it_id_proveedor.id_item', 'ingreso_bodega.id_proveedor')
            ->join('item as it_id_codigo', 'it_id_codigo.id_item', 'ingreso_bodega.id_codigo')
            ->join('item as it_id_libro', 'it_id_libro.id_item', 'ingreso_bodega.id_libro')
            ->join('item as it_id_categoria_producto', 'it_id_categoria_producto.id_item', 'ingreso_bodega.id_categoria_producto')
            ->join('item as it_id_dependencia', 'it_id_dependencia.id_item', 'ingreso_bodega.id_dependencia')
            ->join('item as it_id_programa', 'it_id_programa.id_item', 'ingreso_bodega.id_programa')
            ->orderBy('ingreso_bodega.id_ingreso_bodega', 'desc')
            ->get([
                'ingreso_bodega.id_ingreso_bodega as id_ingreso_bodega',
                'it_id_forma.descripcion as id_forma',
                'it_id_serie.descripcion as id_serie',
                'ingreso_bodega.numero as numero',
                'ingreso_bodega.factura_serie as factura_serie',
                'ingreso_bodega.numero_dte as numero_dte',
                'ingreso_bodega.fecha as fecha',
                'it_id_proveedor.descripcion as id_proveedor',
                'it_id_codigo.descripcion as id_codigo',
                'it_id_libro.descripcion as id_libro',
                'ingreso_bodega.numero_libro as numero_libro',
                'it_id_categoria_producto.descripcion as id_categoria_producto',
                'it_id_dependencia.descripcion as id_dependencia',
                'it_id_programa.descripcion as id_programa',
                'ingreso_bodega.observaciones as observaciones',
                'ingreso_bodega.costo as costo',
            ]);

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function Pdf($id_ingreso_bodega)
    {
        $ingreso = Ingreso::join('item as it_id_forma', 'it_id_forma.id_item', 'ingreso_bodega.id_forma')
            ->join('item as it_id_serie', 'it_id_serie.id_item', 'ingreso_bodega.id_serie')
            ->join('item as it_id_proveedor', 'it_id_proveedor.id_item', 'ingreso_bodega.id_proveedor')
            ->join('item as it_id_codigo', 'it_id_codigo.id_item', 'ingreso_bodega.id_codigo')
            ->join('item as it_id_libro', 'it_id_libro.id_item', 'ingreso_bodega.id_libro')
            ->join('item as it_id_categoria_producto', 'it_id_categoria_producto.id_item', 'ingreso_bodega.id_categoria_producto')
            ->join('item as it_id_dependencia', 'it_id_dependencia.id_item', 'ingreso_bodega.id_dependencia')
            ->join('item as it_id_programa', 'it_id_programa.id_item', 'ingreso_bodega.id_programa')
            ->where('ingreso_bodega.id_ingreso_bodega', '=', $id_ingreso_bodega)
            ->orderBy('ingreso_bodega.id_ingreso_bodega', 'desc')
            ->get([
                'ingreso_bodega.id_ingreso_bodega as id_ingreso_bodega',
                'it_id_forma.descripcion as id_forma',
                'it_id_serie.descripcion as id_serie',
                'ingreso_bodega.numero as numero',
                'ingreso_bodega.factura_serie as factura_serie',
                'ingreso_bodega.numero_dte as numero_dte',
                'ingreso_bodega.fecha as fecha',
                'it_id_proveedor.descripcion as id_proveedor',
                'it_id_codigo.descripcion as id_codigo',
                'it_id_libro.descripcion as id_libro',
                'ingreso_bodega.numero_libro as numero_libro',
                'it_id_categoria_producto.descripcion as id_categoria_producto',
                'it_id_dependencia.descripcion as id_dependencia',
                'it_id_programa.descripcion as id_programa',
                'ingreso_bodega.observaciones as observaciones',
                'ingreso_bodega.costo as costo',
            ]);

        $ingreso_detalles = IngresoDetalle::join('producto as pro', 'pro.id_producto', 'detalle_ingreso_bodega.id_nombre_producto')
            ->join('item as it_id_accion_farmacologica', 'it_id_accion_farmacologica.id_item', 'detalle_ingreso_bodega.id_accion_farmacologica')
            ->join('item as it_id_laboratorio', 'it_id_laboratorio.id_item', 'detalle_ingreso_bodega.id_laboratorio')
            ->join('item as it_id_presentacion_unidad_de_medida', 'it_id_presentacion_unidad_de_medida.id_item', 'detalle_ingreso_bodega.id_presentacion_unidad_de_medida')
            ->join('item as it_id_marca', 'it_id_marca.id_item', 'detalle_ingreso_bodega.id_marca')
            ->join('item as it_id_codigo_gasto_renglon', 'it_id_codigo_gasto_renglon.id_item', 'detalle_ingreso_bodega.id_codigo_gasto_renglon')
            ->where('detalle_ingreso_bodega.id_ingreso_bodega', '=', $id_ingreso_bodega)
            ->orderBy('detalle_ingreso_bodega.id_detalle_ingreso_bodega', 'desc')
            ->get([
                'pro.descripcion as id_nombre_producto',
                'it_id_accion_farmacologica.descripcion as id_accion_farmacologica',
                'it_id_laboratorio.descripcion as id_laboratorio',
                'detalle_ingreso_bodega.concentracion as concentracion',
                'it_id_presentacion_unidad_de_medida.descripcion as id_presentacion_unidad_de_medida',
                'it_id_marca.descripcion as id_marca',
                'detalle_ingreso_bodega.lote as lote',
                'detalle_ingreso_bodega.fecha_vencimiento as fecha_vencimiento',
                'detalle_ingreso_bodega.cantidad as cantidad',
                'detalle_ingreso_bodega.precio_unidad as precio_unidad',
                'it_id_codigo_gasto_renglon.descripcion as id_codigo_gasto_renglon',
                'orden_cp_y_p_numero',
                'detalle_ingreso_bodega.orden_cp_y_p_numero as orden_cp_y_p_numero',
                'detalle_ingreso_bodega.folio_libro_inventario as folio_libro_inventario',
                'detalle_ingreso_bodega.nomenclatura_de_cuentas as nomenclatura_de_cuentas',
                'detalle_ingreso_bodega.folio_almacen as folio_almacen',
            ]);

        $mensaje = 'CONSTANCIA DE INGRESO A ALMACEN Y A INVENTARIO';

        $pdf = PDF::loadView('ingreso_bodega.pdf.pdf', compact('mensaje', 'ingreso', 'ingreso_detalles'));
        $pdf->set_paper(array(0, 0, 612.00, 792.00), 'portrait');

        return $pdf->stream('ingresos_a_bodega.pdf.pdf', array('Attachment' => 0));
    }

    public function index()
    {
        return view('ingreso_bodega.main_tabla_ingreso');
    }

    public function ingresoBodega()
    {
        return view('ingreso_bodega.index');
    }

    public function store(Request $request)
    {
        $inputs = [
            'id_forma' => 'required',
            'id_serie' => 'required',
            'numero' => 'required',
            'factura_serie' => 'required',
            'numero_dte' => 'required',
            'fecha' => 'required',
            'id_proveedor' => 'required',
            'id_codigo' => 'required',
            'id_libro' => 'required',
            'numero_libro' => 'required',
            'id_categoria_producto' => 'required',
            'id_dependencia' => 'required',
            'id_programa' => 'required',
            'costo' => 'required',
        ];

        $mensajes = [
            'id_forma.required' => ' Obligatorio',
            'id_serie.required' => ' Obligatorio',
            'numero.required' => ' Obligatorio',
            'factura_serie.required' => ' Obligatorio',
            'numero_dte.required' => ' Obligatorio',
            'fecha.required' => ' Obligatorio',
            'id_proveedor.required' => ' Obligatorio',
            'id_codigo.required' => ' Obligatorio',
            'id_libro.required' => ' Obligatorio',
            'numero_libro.required' => ' Obligatorio',
            'id_categoria_producto.required' => ' Obligatorio',
            'id_dependencia.required' => ' Obligatorio',
            'id_programa.required' => ' Obligatorio',
            'costo.required' => ' Obligatorio',
        ];

        $validator = Validator::make($request->all(), $inputs, $mensajes);

        if ($validator->fails()) {
            $result = $validator->errors();
            return response()->json($result, 500);
        }

        try {
            DB::beginTransaction();
            $ingreso = new Ingreso;
            $ingreso->id_forma = $request->id_forma;
            $ingreso->id_serie = $request->id_serie;
            $ingreso->numero = $request->numero;
            $ingreso->factura_serie = $request->factura_serie;
            $ingreso->numero_dte = $request->numero_dte;
            $ingreso->fecha = $request->fecha;
            $ingreso->id_proveedor = $request->id_proveedor;
            $ingreso->id_codigo = $request->id_codigo;
            $ingreso->id_libro = $request->id_libro;
            $ingreso->numero_libro = $request->numero_libro;
            $ingreso->id_categoria_producto = $request->id_categoria_producto;
            $ingreso->id_dependencia = $request->id_dependencia;
            $ingreso->id_programa = $request->id_programa;
            $ingreso->observaciones = $request->observaciones;
            $ingreso->costo = 10;

            $ingreso->save();

            $id_nombre_producto = $request->id_nombre_producto;
            $id_accion_farmacologica = $request->id_accion_farmacologica;
            $id_laboratorio = $request->id_laboratorio;
            $concentracion = $request->concentracion;
            $id_presentacion_unidad_de_medida = $request->id_presentacion_unidad_de_medida;
            $id_marca = $request->id_marca;
            $lote = $request->lote;
            $fecha_vencimiento = $request->fecha_vencimiento;
            $cantidad = $request->cantidad;
            $precio_unidad = $request->precio_unidad;
            $id_codigo_gasto_renglon = $request->id_codigo_gasto_renglon;
            $orden_cp_y_p_numero = $request->orden_cp_y_p_numero;
            $folio_libro_inventario = $request->folio_libro_inventario;
            $nomenclatura_de_cuentas = $request->nomenclatura_de_cuentas;
            $folio_almacen = $request->folio_almacen;

            for ($count = 0; $count < count($id_nombre_producto); $count++) {
                $ingreso_detalle = new IngresoDetalle;
                $ingreso_detalle->id_ingreso_bodega = $ingreso->id_ingreso_bodega;
                $ingreso_detalle->id_nombre_producto = $id_nombre_producto[$count];
                $ingreso_detalle->id_accion_farmacologica = $id_accion_farmacologica[$count];
                $ingreso_detalle->id_laboratorio = $id_laboratorio[$count];
                $ingreso_detalle->concentracion = $concentracion[$count];
                $ingreso_detalle->id_presentacion_unidad_de_medida = $id_presentacion_unidad_de_medida[$count];
                $ingreso_detalle->id_marca = $id_marca[$count];
                $ingreso_detalle->lote = $lote[$count];
                $ingreso_detalle->fecha_vencimiento = $fecha_vencimiento[$count];
                $ingreso_detalle->cantidad = $cantidad[$count];
                $ingreso_detalle->precio_unidad = $precio_unidad[$count];
                $ingreso_detalle->id_codigo_gasto_renglon = $id_codigo_gasto_renglon[$count];
                $ingreso_detalle->orden_cp_y_p_numero = $orden_cp_y_p_numero[$count];
                $ingreso_detalle->folio_libro_inventario = $folio_libro_inventario[$count];
                $ingreso_detalle->nomenclatura_de_cuentas = $nomenclatura_de_cuentas[$count];
                $ingreso_detalle->folio_almacen = $folio_almacen[$count];

                $ingreso_detalle->save();
            }

            DB::commit();
            return response()->json(['success' => 'Ingreso y detalle registrado']);
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    /* -------------------------------- */
    /* select ingreso */

    public function selectForma()
    {
        $item = Item::where('id_categoria', '5')
            ->get();
        $r = response()->json($item);
        return $r;
    }

    public function selectSerie()
    {
        $item = Item::where('id_categoria', '6')
            ->get();
        $r = response()->json($item);
        return $r;
    }

    public function selectProveedor()
    {
        $item = Item::where('id_categoria', '7')
            ->get();
        $r = response()->json($item);
        return $r;
    }

    public function selectCodigo()
    {
        $item = Item::where('id_categoria', '8')
            ->get();
        $r = response()->json($item);
        return $r;
    }

    public function selectLibro()
    {
        $item = Item::where('id_categoria', '9')
            ->get();
        $r = response()->json($item);
        return $r;
    }

    public function selectCategoriaProducto()
    {

        $item = Item::where('id_categoria', '11')
            ->get();
        $r = response()->json($item);
        return $r;
    }

    public function selectDependencia()
    {
        $item = Item::where('id_categoria', '10')
            ->get();
        $r = response()->json($item);
        return $r;
    }

    public function selectPrograma()
    {
        $item = Item::where('id_categoria', '12')
            ->get();
        $r = response()->json($item);
        return $r;
    }

    /* --------------------------------- */
    /* select detalle ingreso */
    public function selectidaccionfarmacologica()
    {
        $item = Item::where('id_categoria', '13')
            ->get();
        $r = response()->json($item);
        return $r;
    }

    public function selectselectidnombreproducto(Request $request)
    {
        $item = Producto::leftjoin('detalle_ingreso_bodega as dib', 'dib.id_nombre_producto', 'producto.id_producto')
            ->where('id_categoria', $request->categoria_producto)
            ->get([
                'producto.id_producto as id_producto',
                'producto.id_categoria as id_categoria',
                'producto.id_accion_farmacologica as id_accion_farmacologica',
                'producto.descripcion as descripcion',
                'producto.stock as stock',
                'dib.precio_unidad as precio_unidad',
            ]);
            //dd($item);
        $r = response()->json($item);
        return $r;
    }

    public function selectidlaboratorio()
    {
        $item = Item::where('id_categoria', '14')
            ->get();
        $r = response()->json($item);
        return $r;
    }

    public function selectidpresentacionunidaddemedida()
    {
        $item = Item::where('id_categoria', '15')
            ->get();
        $r = response()->json($item);
        return $r;
    }

    public function selectidmarca()
    {
        $item = Item::where('id_categoria', '16')
            ->get();
        $r = response()->json($item);
        return $r;
    }

    public function selectidcodigogastorenglon()
    {
        $item = Item::where('id_categoria', '17')
            ->get();
        $r = response()->json($item);
        return $r;
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use App\Models\EgresoDetalle;
use App\Models\Egresos;
use App\Models\Item;
use App\Models\Paciente;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PDF;

class EgresosBodegaController extends Controller
{
    public function index()
    {
        return view('egreso_bodega.main_tabla_egreso');
    }

    public function listarEgresos(Request $request)
    {
        $data = Egresos::leftJoin('item as i', 'i.id_item', 'pedido_despacho.id_lugar')
            ->leftJoin('colaborador as c', 'c.id_colaborador', 'pedido_despacho.id_entrega')
            ->leftJoin('colaborador as colab', 'colab.id_colaborador', 'pedido_despacho.id_autoriza')
            ->leftJoin('persona as p_entrega', 'p_entrega.id_persona', 'c.id_persona')
            ->leftJoin('persona as p_autoriza', 'p_autoriza.id_persona', 'colab.id_persona')

            ->leftJoin('paciente as pac', 'pac.id_paciente', 'pedido_despacho.id_solicitante_paciente')
            ->leftJoin('persona as sol_pac', 'sol_pac.id_persona', 'pac.id_persona')

            ->leftJoin('colaborador as col', 'col.id_colaborador', 'pedido_despacho.id_solicitante_colaborador')
            ->leftJoin('persona as sol_col', 'sol_col.id_persona', 'col.id_persona')
            
            ->leftJoin('item as cat_prod', 'cat_prod.id_item', 'pedido_despacho.id_categoria_producto')
            ->get([
                'pedido_despacho.id_pedido_despacho as id_pedido_despacho',
                'pedido_despacho.pedido as pedido',
                'i.descripcion as descripcion',
                'pedido_despacho.fecha_pedido as fecha_pedido',
                'pedido_despacho.fecha_ingreso as fecha_ingreso',
                'pedido_despacho.fecha_entrega as fecha_entrega',
                'p_entrega.nombres as nombres_entrega',
                'p_entrega.apellidos as apellidos_entrega',
                'p_autoriza.nombres as nombres_autoriza',
                'p_autoriza.apellidos as apellidos_autoriza',
                'sol_pac.nombres as nombres_paciente',
                'sol_pac.apellidos as apellidos_paciente',
                'sol_col.nombres as nombres_colaborador',
                'sol_col.apellidos as apellidos_colaborador',
                'cat_prod.descripcion as descripcion_cat',
                'pedido_despacho.total as total',
            ]);

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function indexegresobodega()
    {
        return view('egreso_bodega.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //dd($request);
        $inputs = [
            'pedido' => 'required',
            'id_lugar' => 'required',
            'fecha_pedido' => 'required',
            'fecha_ingreso' => 'required',
            'fecha_entrega' => 'required',
            'id_entrega' => 'required',
            'id_autoriza' => 'required',
            'id_solicitante' => 'required',
            'id_categoria_producto' => 'required',
            'total' => 'required',
        ];

        $mensajes = [
            'pedido.required' => ' Obligatorio',
            'id_lugar.required' => ' Obligatorio',
            'fecha_pedido.required' => ' Obligatorio',
            'fecha_ingreso.required' => ' Obligatorio',
            'fecha_entrega.required' => ' Obligatorio',
            'id_entrega.required' => ' Obligatorio',
            'id_autoriza.required' => ' Obligatorio',
            'id_solicitante.required' => ' Obligatorio',
            'id_categoria_producto.required' => ' Obligatorio',
            'total.required' => ' Obligatorio',
        ];

        $validator = Validator::make($request->all(), $inputs, $mensajes);

        if ($validator->fails()) {
            $result = $validator->errors();
            return response()->json($result, 500);
        }
        try {
            DB::beginTransaction();
            $egreso = new Egresos;
            $egreso->pedido = $request->pedido;
            $egreso->id_lugar = $request->id_lugar;
            $egreso->fecha_pedido = $request->fecha_pedido;
            $egreso->fecha_ingreso = $request->fecha_ingreso;
            $egreso->fecha_entrega = $request->fecha_entrega;
            $egreso->id_entrega = $request->id_entrega;
            $egreso->id_autoriza = $request->id_autoriza;
            $cadena = $request->id_solicitante;
            $ultimo = $cadena[strlen($cadena) - 1]; //otiene el ultimo numero que es la bandera que se le esta mandando en el select
            if ($ultimo == 1) {
                $p = substr((int) $cadena, 0, -1); //elimina el ultimo numero y lo conviente a int
                $egreso->id_solicitante_paciente = $p;
            }
            if ($ultimo == 2) {
                $c = substr((int) $cadena, 0, -1); //elimina el ultimo numero y lo conviente a int
                $egreso->id_solicitante_colaborador = $c;
            }
            $egreso->id_categoria_producto = $request->id_categoria_producto;
            $egreso->total = $request->total;

            //dd($egreso->id_solicitante_paciente, $egreso->id_solicitante_colaborador);

            $egreso->save();

            $id_nombre_medicamento = $request->id_nombre_medicamento;
            $cantidad_solicitada = $request->cantidad_solicitada;
            $cantidad_despachada = $request->cantidad_despachada;
            $precio = $request->precio;

            for ($count = 0; $count < count($id_nombre_medicamento); $count++) {
                $egreso_detalle = new EgresoDetalle;
                $egreso_detalle->id_pedido_despacho = $egreso->id_pedido_despacho;
                $egreso_detalle->id_nombre_medicamento = $id_nombre_medicamento[$count];
                $egreso_detalle->cantidad_solicitada = $cantidad_solicitada[$count];
                $egreso_detalle->cantidad_despachada = $cantidad_despachada[$count];
                $egreso_detalle->precio = $precio[$count];

                $egreso_detalle->save();
            }

            DB::commit();
            return response()->json(['success' => 'Engreso y detalle registrado']);
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function selectlugar()
    {
        $item = Item::where('id_categoria', '18')
            ->get();
        $r = response()->json($item);
        return $r;
    }

    public function selectentrega()
    {
        $item = Colaborador::join('persona as per', 'per.id_persona', '=', 'colaborador.id_persona')
            ->get([
                'colaborador.id_colaborador as id_colaborador',
                'per.nombres as nombres',
                'per.apellidos as apellidos'
            ]);
        $r = response()->json($item);
        return $r;
    }

    public function selectSolicitante(Request $request)
    {
        $colaborador = Colaborador::join('persona as per', 'per.id_persona', '=', 'colaborador.id_persona')
            ->get([
                'colaborador.id_colaborador as id_colaborador',
                'colaborador.bandera as bandera',
                'per.nombres as nombres',
                'per.apellidos as apellidos'
            ]);
        $r = response()->json($colaborador);
        return $r;
    }

    public function selectSolicitantePaciente()
    {
        $paciente = Paciente::join('persona as per', 'per.id_persona', '=', 'paciente.id_persona')
            ->get([
                'paciente.id_paciente as id_paciente',
                'paciente.bandera as bandera',
                'per.nombres as nombres',
                'per.apellidos as apellidos'
            ]);
        $r = response()->json($paciente);
        return $r;
    }

    public function PdfEgreso($id_pedido_despacho)
    {
        $egreso = Egresos::leftJoin('item as i', 'i.id_item', 'pedido_despacho.id_lugar')
            ->leftJoin('colaborador as c', 'c.id_colaborador', 'pedido_despacho.id_entrega')
            ->leftJoin('colaborador as colab', 'colab.id_colaborador', 'pedido_despacho.id_autoriza')
            ->leftJoin('persona as p_entrega', 'p_entrega.id_persona', 'c.id_persona')
            ->leftJoin('persona as p_autoriza', 'p_autoriza.id_persona', 'colab.id_persona')
            ->leftJoin('paciente as pac', 'pac.id_paciente', 'pedido_despacho.id_solicitante_paciente')
            ->leftJoin('colaborador as col', 'col.id_colaborador', 'pedido_despacho.id_solicitante_colaborador')
            ->leftJoin('persona as sol_pac', 'sol_pac.id_persona', 'pac.id_persona')
            ->leftJoin('persona as sol_col', 'sol_col.id_persona', 'col.id_persona')
            ->leftJoin('item as cat_prod', 'cat_prod.id_item', 'pedido_despacho.id_categoria_producto')
            ->where('pedido_despacho.id_pedido_despacho', '=', $id_pedido_despacho)
            ->get([
                'pedido_despacho.id_pedido_despacho as id_pedido_despacho',
                'pedido_despacho.pedido as pedido',
                'i.descripcion as descripcion',
                'pedido_despacho.fecha_pedido as fecha_pedido',
                'pedido_despacho.fecha_ingreso as fecha_ingreso',
                'pedido_despacho.fecha_entrega as fecha_entrega',
                'p_entrega.nombres as nombres_entrega',
                'p_entrega.apellidos as apellidos_entrega',
                'p_autoriza.nombres as nombres_autoriza',
                'p_autoriza.apellidos as apellidos_autoriza',
                'sol_pac.nombres as nombres_paciente',
                'sol_pac.apellidos as apellidos_paciente',
                'sol_col.nombres as nombres_colaborador',
                'sol_col.apellidos as apellidos_colaborador',
                'cat_prod.descripcion as descripcion_cat',
                'pedido_despacho.total as total',
            ]);

        $egreso_detalles = EgresoDetalle::join('producto as p', 'p.id_producto', 'detalle_pedido_despacho.id_nombre_medicamento')
            ->where('detalle_pedido_despacho.id_pedido_despacho', '=', $id_pedido_despacho)
            ->get([
                'p.descripcion as producto',
                'detalle_pedido_despacho.cantidad_solicitada as cantidad_solicitada',
                'detalle_pedido_despacho.cantidad_despachada as cantidad_despachada',
                'detalle_pedido_despacho.precio as precio',
            ]);

        $mensaje = 'CONSTANCIA DE EGRESO DEL ALMACEN Y DEL INVENTARIO';

        $pdf = PDF::loadView('egreso_bodega.pdf.pdf', compact('mensaje', 'egreso', 'egreso_detalles'));
        $pdf->set_paper(array(0, 0, 612.00, 792.00), 'portrait');

        return $pdf->stream('egreso_bodega.pdf.pdf', array('Attachment' => 0));
    }
}
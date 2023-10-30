<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\PedidoDetalle;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class PedidosController extends Controller
{
    public function index()
    {
        return view('pedidos.index');
    }

    public function buscarCliente(Request $request)
    {
        $cliente = Cliente::where('nombres', 'LIKE', "%{$request->nombres}%")
            ->where('apellidos', 'LIKE', "%{$request->apellidos}%")
            ->where('telefono', 'LIKE', "%{$request->telefono}%")
            ->where('correo_electronico', 'LIKE', "%{$request->correo_electronico}%")
            ->first();
        if (!empty($cliente)) {
            return response()->json($cliente);
        } else {
            return response()->json(['no_data' => 'El cliente no existe']);
        }
    }

    public function store(Request $request)
    {
        $inputs = [
            /* pedidos */
            'id_cliente' => 'required',
            'fecha_entrega' => 'required',
            'anticipo' => 'nullable|numeric',
            'completo' => 'nullable|numeric',

            /* detalle de los pedidos */
        ];

        $mensajes = [
            /* mensajes para las validaciones los pedidos */
            'id_cliente.required' => ' El cliente es obligatorio',
            'fecha_entrega.required' => ' La fecha de entrega es obligatoria',
            'anticipo.numeric' => ' Solo valores numéricos',
            'completo.numeric' => ' Solo valores numéricos',

            /* mensaje para las validaciones tabla servicio detalle */
        ];

        $validator = Validator::make($request->all(), $inputs, $mensajes);

        if ($validator->fails()) {
            $result = $validator->errors();
            return response()->json($result, 500);
        }

        try {
            DB::beginTransaction();
            $pedido = new Pedido;
            $pedido->id_cliente  = $request->id_cliente;
            $pedido->costo = $request->costo;
            $pedido->anticipo = $request->anticipo;
            $pedido->completo = $request->completo;
            $pedido->pendiente = $request->pendiente;
            $pedido->fecha_ingreso = Carbon::now();
            $pedido->fecha_entrega = $request->fecha_entrega;
            $pedido->estado = 1;

            $pedido->save();

            $id_tipo_prenda = $request->id_tipo_prenda;
            $id_tela = $request->id_tela;
            $id_color = $request->id_color;
            $largo = $request->largo;
            $cadera = $request->cadera;
            $cantidad = $request->cantidad;
            $precio = $request->precio;
            $observaciones = $request->observaciones;
            $cadera = $request->cadera;
            $talle = $request->talle;
            $hombro_caido = $request->hombro_caido;
            $punio = $request->punio;
            $id_vens = $request->id_vens;
            $pa = $request->pa;
            $espalda = $request->espalda;
            $largo_manga = $request->largo_manga;
            $codo = $request->codo;
            $sisa = $request->sisa;
            $pecho = $request->pecho;
            $estomago = $request->estomago;
            $hombro = $request->hombro;

            /* $fondo = $request->fondo;
            $entrepierna = $request->entrepierna;
            $cintura = $request->cintura;
            $pierna = $request->pierna;
            $rodilla = $request->rodilla;
            $ruedo = $request->ruedo; */

            for ($count = 0; $count < count($id_tipo_prenda); $count++) {

                $pedido_detalle = new PedidoDetalle;
                $pedido_detalle->id_pedido = $pedido->id_pedido;
                $pedido_detalle->id_tipo_prenda = $id_tipo_prenda[$count];
                $pedido_detalle->id_tela = $id_tela[$count];
                $pedido_detalle->id_color = $id_color[$count];
                $pedido_detalle->largo = $largo[$count];
                $pedido_detalle->cadera = $cadera[$count];
                $pedido_detalle->cantidad = $cantidad[$count];
                $pedido_detalle->precio = $precio[$count];
                $pedido_detalle->observaciones = $observaciones[$count];
                $pedido_detalle->cadera = $cadera[$count];
                $pedido_detalle->talle = $talle[$count];
                $pedido_detalle->hombro_caido = $hombro_caido[$count];
                $pedido_detalle->punio = $punio[$count];
                $pedido_detalle->id_vens = $id_vens[$count];
                $pedido_detalle->pa = $pa[$count];
                $pedido_detalle->espalda = $espalda[$count];
                $pedido_detalle->largo_manga = $largo_manga[$count];
                $pedido_detalle->codo = $codo[$count];
                $pedido_detalle->sisa = $sisa[$count];
                $pedido_detalle->pecho = $pecho[$count];
                $pedido_detalle->estomago = $estomago[$count];
                $pedido_detalle->hombro = $hombro[$count];

                /* $pedido_detalle->fondo = $fondo[$count];
                $pedido_detalle->entrepierna = $entrepierna[$count];
                $pedido_detalle->cintura = $cintura[$count];
                $pedido_detalle->pierna = $pierna[$count];
                $pedido_detalle->rodilla = $rodilla[$count];
                $pedido_detalle->ruedo = $ruedo[$count]; */

                $pedido_detalle->save();
            }

            DB::commit();
            return response()->json(['success' => 'Pedido y detalle registrado']);
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function selectCategoriaIdTela()
    {
        $item = Item::where('id_cat', '2')
            ->get();
        $r = response()->json($item);
        return $r;
    }

    public function selectCategoriaIdColor()
    {
        $item = Item::where('id_cat', '3')
            ->get();
        $r = response()->json($item);
        return $r;
    }

    public function selectCategoriaIdVens()
    {
        $item = Item::where('id_cat', '4')
            ->get();
        $r = response()->json($item);
        return $r;
    }

    public function selectCategoriaIdPaletones()
    {
        $item = Item::where('id_cat', '5')
            ->get();
        $r = response()->json($item);
        return $r;
    }
}

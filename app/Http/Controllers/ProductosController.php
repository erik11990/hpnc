<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Ingreso;
use App\Models\Item;
use App\Models\Producto;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductosController extends Controller
{
    public function index()
    {
        return view('productos.index');
    }

    public function listarProductos(Request $request)
    {
        $data = Producto::join('item as cat', 'cat.id_item', 'producto.id_categoria')
            ->join('item as af', 'af.id_item', 'producto.id_accion_farmacologica')
            ->orderBy('producto.id_producto', 'desc')
            ->get([
                'producto.id_categoria as id_categoria',
                'producto.id_accion_farmacologica as id_accion_farmacologica',
                'producto.id_producto as id_producto',
                'cat.descripcion as categoria',
                'af.descripcion as af',
                'producto.descripcion as producto',
                'producto.stock as stock',
            ]);

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        if ($request->id_categoria_mp == 26) {
            $inputs = [
                'id_categoria_mp' => 'required',
                'id_accion_farmacologica' => 'required',
                'descripcion' => 'required',
            ];

            $mensajes = [
                'id_categoria_mp.required' => ' Obligatorio',
                'id_accion_farmacologica.required' => ' Obligatorio',
                'descripcion.required' => ' Obligatorio',
            ];
        } else {
            $inputs = [
                'id_categoria_mp' => 'required',
                'descripcion' => 'required',
            ];

            $mensajes = [
                'id_categoria_mp.required' => ' Obligatorio',
                'descripcion.required' => ' Obligatorio',
            ];
        }

        $validator = Validator::make($request->all(), $inputs, $mensajes);

        if ($validator->fails()) {
            $result = $validator->errors();
            return response()->json($result, 500);
        }

        $producto = new Producto;
        $producto->id_categoria = $request->id_categoria_mp;
        $producto->id_accion_farmacologica = $request->id_accion_farmacologica;
        $producto->stock = 0;
        $producto->descripcion = $request->descripcion;

        $producto->save();
        return response()->json(['success' => 'Producto registrado']);
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
        if ($request->id_categoria_mp == 26) {
            $inputs = [
                'id_categoria_mp' => 'required',
                'id_accion_farmacologica' => 'required',
                'descripcion' => 'required',
            ];

            $mensajes = [
                'id_categoria_mp.required' => ' Obligatorio',
                'id_accion_farmacologica.required' => ' Obligatorio',
                'descripcion.required' => ' Obligatorio',
            ];
        } else {
            $inputs = [
                'id_categoria_mp' => 'required',
                'descripcion' => 'required',
            ];

            $mensajes = [
                'id_categoria_mp.required' => ' Obligatorio',
                'descripcion.required' => ' Obligatorio',
            ];
        }

        $validator = Validator::make($request->all(), $inputs, $mensajes);

        if ($validator->fails()) {
            $result = $validator->errors();
            return response()->json($result, 500);
        }

        $producto = Producto::find($request->id_producto);
        $producto->id_categoria = $request->id_categoria_mp;
        $producto->id_accion_farmacologica = $request->id_accion_farmacologica;
        $producto->descripcion = $request->descripcion;

        $producto->save();
        return response()->json(['success' => 'Producto actualizado']);
    }

    public function destroy($id)
    {
        //
    }

    public function selectAccionFarmacologica(Request $request)
    {
        $af = Item::where('id_categoria', '=', 13)
            ->get();
        $r = response()->json($af);
        return $r;
    }
}

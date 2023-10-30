<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Item;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use DataTables;

class ItemsController extends Controller
{
    public function index()
    {
        return view('items.index');
    }

    public function show(){

    }

    public function store(Request $request)
    {
        $inputs = [
            'id_categoria' => 'required',
            'descripcion' => 'required|regex:/^[\pL\s\-]+$/u|unique:item',
        ];

        $mensajes = [
            'id_categoria.required' => 'Obligatorio',
            'descripcion.required' => 'Obligatorio',
            'descripcion.regex' => 'Solo letras',
            'descripcion.unique' => 'El ítem ya existe',
        ];

        $validator = Validator::make($request->all(), $inputs, $mensajes);

        if ($validator->fails()) {
            $result = $validator->errors();
            return response()->json($result, 500);
        }

        $item = new Item;
        $item->id_categoria = $request->id_categoria;
        $item->descripcion = $request->descripcion;

        $item->save();
        return response()->json(['success' => 'Item registrado']);
    }

    public function update(Request $request, $id)
    {
        $inputs = [
            'id_categoria' => 'required',
            'descripcion' => 'required|regex:/^[\pL\s\-]+$/u|unique:item,descripcion,' . $id . ',id_item',
        ];

        $mensajes = [
            'id_categoria.required' => ' Obligatorio',
            'descripcion.required' => ' Obligatorio',
            'descripcion.regex' => ' Solo letras',
            'descripcion.unique' => 'La descripción ya existe',
        ];

        $validator = Validator::make($request->all(), $inputs, $mensajes);

        if ($validator->fails()) {
            $result = $validator->errors();
            return response()->json($result, 500);
        }

        $item = new Item;
        $item = Item::find($request->id_item);
        $item->id_categoria = $request->id_categoria;
        $item->descripcion = $request->descripcion;

        $item->save();
        return response()->json(['success' => 'Item actualizado']);
    }

    public function listarItems(Request $request)
    {
        $data = Item::join('categoria as cat', 'cat.id_categoria', 'item.id_categoria')
            ->orderBy('item.id_item', 'desc')
            ->get([
                'cat.id_categoria as id_categoria',
                'cat.descripcion as categoria',
                'item.id_item as id_item',
                'item.descripcion as descripcion'
            ]);

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function selectCategoria()
    {
        $item = Categoria::get();
        $r = response()->json($item);
        return $r;
    }
}

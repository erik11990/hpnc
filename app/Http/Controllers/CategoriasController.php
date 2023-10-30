<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use DataTables;

class CategoriasController extends Controller
{
    public function index()
    {
        return view('categorias.index');
    }

    public function store(Request $request)
    {
        $inputs = [
            'descripcion' => 'required|regex:/^[\pL\s\-]+$/u|unique:categoria',
        ];

        $mensajes = [
            'descripcion.required' => 'Obligatorio',
            'descripcion.regex' => 'Solo letras',
            'descripcion.unique' => 'La categoría ya existe'
        ];

        $validator = Validator::make($request->all(), $inputs, $mensajes);

        if ($validator->fails()) {
            $result = $validator->errors();
            return response()->json($result, 500);
        }

        $categoria = new Categoria;
        $categoria->descripcion = $request->descripcion;

        $categoria->save();

        return response()->json(['success' => 'Categoría registrada']);
    }

    public function show()
    {
    }

    public function update(Request $request, $id)
    {
        $inputs = [
            'descripcion' => 'required|regex:/^[\pL\s\-]+$/u|unique:categoria,descripcion,' . $id . ',id_categoria'
        ];

        $mensajes = [
            'descripcion.required' => 'Obligatorio',
            'descripcion.regex' => 'Solo letras',
            'descripcion.unique' => 'La categoría ya existe'
        ];

        $validator = Validator::make($request->all(), $inputs, $mensajes);

        if ($validator->fails()) {
            $result = $validator->errors();
            return response()->json($result, 500);
        }

        $categoria = Categoria::find($request->id_categoria);
        $categoria->descripcion = $request->descripcion;

        $categoria->save();
        return response()->json(['success' => 'Categoria actualizada']);
    }

    public function listarCategorias(Request $request)
    {
        $data = Categoria::select()
            ->orderBy('id_categoria', 'desc')
            ->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
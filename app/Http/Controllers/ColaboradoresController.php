<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Colaborador;
use App\Models\Usuario;
use App\Models\Item;
use DataTables;
use Illuminate\Support\Facades\Validator;

class ColaboradoresController extends Controller
{
    public function index()
    {
        return view('colaboradores.index');
    }

    public function listarColaboradores(Request $request)
    {
        $data = Colaborador::join('persona as per', 'per.id_persona', 'colaborador.id_persona')
            ->join('item as tipo_colaborador', 'tipo_colaborador.id_item', 'colaborador.id_tipo_colabordor')
            ->orderBy('colaborador.id_colaborador', 'desc')
            ->get([
                'colaborador.id_colaborador as id_colaborador',
                'per.id_persona as id_persona',
                'tipo_colaborador.id_item as id_item',
                'tipo_colaborador.descripcion as descripcion',
                'per.nombres as nombres',
                'per.apellidos as apellidos',
                'per.dpi as dpi'
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
        //
    }

    public function store(Request $request)
    {
        $inputs = [
            'id_tipo_colabordor' => 'required',
            'id_persona' => 'required',
        ];

        $mensajes = [
            'id_tipo_colabordor.required' => ' Obligatorio',
            'id_persona.required' => ' Obligatorio',
        ];

        $validator = Validator::make($request->all(), $inputs, $mensajes);

        if ($validator->fails()) {
            $result = $validator->errors();
            return response()->json($result, 500);
        }

        $colaborador = new Colaborador();
        $colaborador->id_tipo_colabordor = $request->id_tipo_colabordor;
        $colaborador->id_persona = $request->id_persona;
        $colaborador->bandera = 2;

        $colaborador->save();
        return response()->json(['success' => 'Colaborador registrado']);
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
        $inputs = [
            'id_tipo_colabordor' => 'required',
            'id_persona' => 'required',
        ];

        $mensajes = [
            'id_tipo_colabordor.required' => ' Obligatorio',
            'id_persona.required' => ' Obligatorio',
        ];

        $validator = Validator::make($request->all(), $inputs, $mensajes);

        if ($validator->fails()) {
            $result = $validator->errors();
            return response()->json($result, 500);
        }

        $colaborador = Colaborador::find($request->id_colaborador);
        $colaborador->id_tipo_colabordor = $request->id_tipo_colabordor;
        $colaborador->id_persona = $request->id_persona;

        $colaborador->save();
        return response()->json(['success' => 'Colaborador Actualizado']);
    }

    public function destroy($id)
    {
        //
    }

    public function selectTipoColaborador()
    {
        $item = Item::where('id_categoria', '=', 4)
            ->get();
        $r = response()->json($item);
        return $r;
    }

    public function buscarPersona(Request $request)
    {
        $persona = Usuario::where('dpi', 'LIKE', "%{$request->dpi}%")
            ->first();
        if (!empty($persona)) {
            return response()->json($persona);
        } else {
            return response()->json(['no_data' => 'La persona no existe']);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Usuario;
use App\Models\Item;
use DataTables;
use Illuminate\Support\Facades\Validator;

class PacientesController extends Controller
{
    public function index()
    {
        return view('pacientes.index');
    }

    public function listarPacientes(Request $request)
    {
        $data = Paciente::join('persona as per', 'per.id_persona', 'paciente.id_persona')
            ->join('item as tipo_paciente', 'tipo_paciente.id_item', 'paciente.id_tipo_paciente')
            ->orderBy('paciente.id_paciente', 'desc')
            ->get([
                'paciente.id_paciente as id_paciente',
                'per.id_persona as id_persona',
                'tipo_paciente.id_item as id_item',
                'tipo_paciente.descripcion as descripcion',
                'per.nombres as nombres',
                'per.apellidos as apellidos',
                'per.dpi as dpi',
                'tipo_paciente.descripcion as descripcion'
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
            'id_tipo_paciente' => 'required',
            'id_persona' => 'required|unique:paciente,id_persona',
        ];

        $mensajes = [
            'id_tipo_paciente.required' => 'El tipo de paciente es obligatorio',
            'id_persona.required' => 'El paciente es obligatorio',
            'id_persona.unique' => 'El paciente ya existe',
        ];

        $validator = Validator::make($request->all(), $inputs, $mensajes);

        if ($validator->fails()) {
            $result = $validator->errors();
            return response()->json($result, 500);
        }

        $paciente = new Paciente();
        $paciente->id_tipo_paciente = $request->id_tipo_paciente;
        $paciente->id_persona = $request->id_persona;
        $paciente->bandera = 1;

        $paciente->save();
        return response()->json(['success' => 'Paciente registrado']);
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
            'id_tipo_paciente' => 'required',
            'id_persona' => 'required|unique:paciente,id_persona,' . $id . ',id_paciente',
        ];

        $mensajes = [
            'id_tipo_paciente.required' => 'El tipo de paciente es obligatorio',
            'id_persona.required' => 'El paciente es obligatorio',
            'id_persona.unique' => 'El paciente ya existe',
        ];

        $validator = Validator::make($request->all(), $inputs, $mensajes);

        if ($validator->fails()) {
            $result = $validator->errors();
            return response()->json($result, 500);
        }

        $paciente = Paciente::find($request->id_paciente);
        $paciente->id_tipo_paciente = $request->id_tipo_paciente;
        $paciente->id_persona = $request->id_persona;

        $paciente->save();
        return response()->json(['success' => 'Paciente registrado']);
    }

    public function destroy($id)
    {
        //
    }

    public function selectTipoPaciente()
    {
        $item = Item::where('id_categoria', '=', 3)
            ->get();
        $r = response()->json($item);
        return $r;
    }

    public function buscarPersona(Request $request)
    {
        $inputs = [
            'dpi' => 'required'
        ];

        $mensajes = [
            'dpi.required' => 'El DPI es obligatorio'
        ];

        $validator = Validator::make($request->all(), $inputs, $mensajes);

        if ($validator->fails()) {
            $result = $validator->errors();
            return response()->json($result, 500);
        } else {
            $persona = Usuario::where('dpi', 'LIKE', "%{$request->dpi}%")
                ->first();
            if (!empty($persona)) {
                return response()->json($persona);
            } else {
                return response()->json(['no_data' => 'La persona no existe']);
            }
        }
    }
}
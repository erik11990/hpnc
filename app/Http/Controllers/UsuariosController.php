<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\Item;
use DataTables;
use Illuminate\Support\Facades\Validator;

class UsuariosController extends Controller
{
    public function index()
    {
        return view('usuarios.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $inputs = [
            'nombres' => 'required',
            'apellidos' => 'required',
            'fecha_nacimiento' => 'required',
            'dpi' => 'required|unique:persona',
            'telefono' => 'required',
            'id_departamento_residencia' => 'required',
            'id_municipio_residencia' => 'required',
            'direccion_residencia' => 'required',
            'nombre_padre' => 'required',
            'nombre_madre' => 'required',
            'id_estado_civil' => 'required',
        ];

        $mensajes = [
            'nombres.required' => ' Obligatorio',
            'apellidos.required' => ' Obligatorio',
            'fecha_nacimiento.required' => ' Obligatorio',
            'dpi.required' => ' Obligatorio',
            'dpi.unique' => ' DPI ya existe',
            'telefono.required' => ' Obligatorio',
            'id_departamento_residencia.required' => ' Obligatorio',
            'id_municipio_residencia.required' => ' Obligatorio',
            'direccion_residencia.required' => ' Obligatorio',
            'nombre_padre.required' => ' Obligatorio',
            'nombre_madre.required' => ' Obligatorio',
            'id_estado_civil.required' => ' Obligatorio',
        ];

        $validator = Validator::make($request->all(), $inputs, $mensajes);

        if ($validator->fails()) {
            $result = $validator->errors();
            return response()->json($result, 500);
        }

        $usuario = new Usuario;
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->fecha_nacimiento = $request->fecha_nacimiento;
        $usuario->dpi = $request->dpi;
        $usuario->telefono = $request->telefono;
        $usuario->id_departamento_residencia = $request->id_departamento_residencia;
        $usuario->id_municipio_residencia = $request->id_municipio_residencia;
        $usuario->direccion_residencia = $request->direccion_residencia;
        $usuario->nombre_padre = $request->nombre_padre;
        $usuario->nombre_madre = $request->nombre_madre;
        $usuario->id_estado_civil = $request->id_estado_civil;

        $usuario->save();

        return response()->json(['success' => 'Usuario registrado']);
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
            'nombres' => 'required',
            'apellidos' => 'required',
            'fecha_nacimiento' => 'required',
            'dpi' => 'required|unique:persona,dpi,' . $id . ',id_persona',
            'telefono' => 'required',
            'id_departamento_residencia' => 'required',
            'id_municipio_residencia' => 'required',
            'direccion_residencia' => 'required',
            'nombre_padre' => 'required',
            'nombre_madre' => 'required',
            'id_estado_civil' => 'required',
        ];

        $mensajes = [
            'nombres.required' => 'Obligatorio',
            'apellidos.required' => 'Obligatorio',
            'fecha_nacimiento.required' => 'Obligatorio',
            'dpi.required' => 'Obligatorio',
            'dpi.unique' => 'El DPI ya existe',
            'telefono.required' => 'Obligatorio',
            'id_departamento_residencia.required' => 'Obligatorio',
            'id_municipio_residencia.required' => 'Obligatorio',
            'direccion_residencia.required' => 'Obligatorio',
            'nombre_padre.required' => 'Obligatorio',
            'nombre_madre.required' => 'Obligatorio',
            'id_estado_civil.required' => 'Obligatorio',
        ];

        $validator = Validator::make($request->all(), $inputs, $mensajes);

        if ($validator->fails()) {
            $result = $validator->errors();
            return response()->json($result, 500);
        }

        $usuario = new Usuario;
        $usuario = Usuario::find($request->id_persona);
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->fecha_nacimiento = $request->fecha_nacimiento;
        $usuario->dpi = $request->dpi;
        $usuario->telefono = $request->telefono;
        $usuario->id_departamento_residencia = $request->id_departamento_residencia;
        $usuario->id_municipio_residencia = $request->id_municipio_residencia;
        $usuario->direccion_residencia = $request->direccion_residencia;
        $usuario->nombre_padre = $request->nombre_padre;
        $usuario->nombre_madre = $request->nombre_madre;
        $usuario->id_estado_civil = $request->id_estado_civil;

        $usuario->save();

        return response()->json(['success' => 'Usuario actualizado']);
    }

    public function destroy($id)
    {
        //
    }

    public function listarUsuarios()
    {
        $data = Usuario::join('departamento as dep', 'dep.id_departamento', 'persona.id_departamento_residencia')
            ->join('municipio as mun', 'mun.id_municipio', 'persona.id_municipio_residencia')
            ->join('item as it', 'it.id_item', 'persona.id_estado_civil')
            ->orderBy('persona.id_persona', 'desc')
            ->get([
                'persona.id_persona as id_persona',
                'persona.nombres as nombres',
                'persona.apellidos as apellidos',
                'persona.fecha_nacimiento as fecha_nacimiento',
                'persona.dpi as dpi',
                'persona.telefono as telefono',
                'dep.id_departamento as id_departamento',
                'dep.descripcion as id_departamento_residencia',
                'mun.id_municipio as id_municipio',
                'mun.descripcion as id_municipio_residencia',
                'persona.direccion_residencia as direccion_residencia',
                'persona.nombre_padre as nombre_padre',
                'persona.nombre_madre as nombre_madre',
                'it.id_item as id_item',
                'it.descripcion as id_estado_civil'
            ]);

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function selectDepartamento()
    {
        $departamento = Departamento::get();
        $r = response()->json($departamento);
        return $r;
    }

    public function selectMunicipio(Request $request)
    {
        $municipio = Municipio::where('id_departamento', '=', $request->departamento)
            ->get();
        $r = response()->json($municipio);
        return $r;
    }

    public function selectEstadoCivil()
    {
        $estado_civil = Item::where('id_categoria', '=', '2')->get();
        $r = response()->json($estado_civil);
        return $r;
    }
}
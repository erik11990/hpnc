<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function listarUsers(Request $request)
    {
        $data = User::get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function index()
    {
        return view("auth.register");
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $inputs = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'rol' => 'required',
        ];

        $mensajes = [
            'name.required' => 'Nombres y apellidos obligatorio',
            'email.required' => 'Email obligatorio',
            'email.email' => 'Debe proporcionar una dirección de correo electrónico válida',
            'email.unique' => 'El correo ya existe',
            'password.required' => 'Contraseña obligatoria',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'rol.required' => 'Rol obligatorio',
        ];


        $validator = Validator::make($request->all(), $inputs, $mensajes);

        if ($validator->fails()) {
            $result = $validator->errors();
            return response()->json($result, 500);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->input("password"));
        $user->rol = $request->rol;
        $user->save();
        return response()->json(['hola' => 'Usuario registrado']);
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        $id = $request->id;
        $password = $request->password;
        $password_confirmation = $request->password_confirmation;

        if ($password == null && $password_confirmation == null) {
            $inputs = [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
                'rol' => 'required',
            ];

            $mensajes = [
                'name.required' => 'Nombres y apellidos obligatorio',
                'email.required' => 'Email obligatorio',
                'email.email' => 'Debe proporcionar una dirección de correo electrónico válida',
                'email.unique' => 'El correo ya existe',
                'rol.required' => 'Rol obligatorio',
            ];

            $validator = Validator::make($request->all(), $inputs, $mensajes);

            if ($validator->fails()) {
                $result = $validator->errors();
                return response()->json($result, 500);
            }

            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->rol = $request->rol;
            $user->save();
        } else {
            $inputs = [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'required|confirmed',
                'rol' => 'required',
            ];

            $mensajes = [
                'name.required' => 'Nombres y apellidos obligatorio',
                'email.required' => 'Email obligatorio',
                'email.email' => 'Debe proporcionar una dirección de correo electrónico válida',
                'email.unique' => 'El correo ya existe',
                'password.required' => 'Contraseña obligatoria',
                'password.confirmed' => 'Las contraseñas no coinciden',
                'rol.required' => 'Rol obligatorio',
            ];

            $validator = Validator::make($request->all(), $inputs, $mensajes);

            if ($validator->fails()) {
                $result = $validator->errors();
                return response()->json($result, 500);
            }

            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->input("password"));
            $user->rol = $request->rol;
            $user->save();
        }


        return response()->json(['hola' => 'Usuario registrado']);
    }

    public function destroy(User $user)
    {
        //
    }

    public function roles()
    {
        $roles = [
            1 => 'Administrador',
            2 => 'Ingreso',
            3 => 'Egreso'
        ];

        return response()->json($roles);
    }
}
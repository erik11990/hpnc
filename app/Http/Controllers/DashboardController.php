<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Paciente;
use App\Models\Colaborador;
use App\Models\User;

class DashboardController extends Controller
{
    function index()
    {
        return view('layouts.master');
    }

    function totalAfiliados()
    {
        $afiliados = Usuario::count();
        $r = response()->json($afiliados);
        return $r;

    }
    function totalPacientes()
    {
        $pacientes = Paciente::count();
        $r = response()->json($pacientes);
        return $r;
    }
    function totalColaboradores()
    {
        $colaboradores = Colaborador::count();
        $r = response()->json($colaboradores);
        return $r;
    }
    function totalUsuarios()
    {
        $colaboradores = User::count();
        $r = response()->json($colaboradores);
        return $r;
    }
}
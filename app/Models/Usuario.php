<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = "persona";

    protected $primaryKey = "id_persona";

    protected $fillable =
    [
        'nombres',
        'apellidos',
        'fecha_nacimiento',
        'dpi',
        'telefono',
        'id_departamento_residencia',
        'id_municipio_residencia',
        'direccion_residencia',
        'nombre_padre',
        'nombre_madre',
        'id_estado_civil',
    ];

    public $timestamps = false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $table = "paciente";

    protected $primaryKey = "id_paciente";

    protected $fillable =
    [
        'id_tipo_paciente',
        'id_persona',
        'bandera',
    ];

    public $timestamps = false;
}

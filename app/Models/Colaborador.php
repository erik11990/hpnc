<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    use HasFactory;

    protected $table = "colaborador";

    protected $primaryKey = "id_colaborador";

    protected $fillable =
    [
        'id_persona',
        'id_tipo_colabordor',
        'bandera'
    ];

    public $timestamps = false;
}

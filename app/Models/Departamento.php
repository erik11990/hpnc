<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $table = "departamento";

    protected $primaryKey = "id_departamento";

    protected $fillable =
    [
        'id_categoria',
        'descripcion'
    ];

    public $timestamps = false;
}

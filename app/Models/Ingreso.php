<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    use HasFactory;

    protected $table = "ingreso_bodega";

    protected $primaryKey = "id_ingreso_bodega";

    protected $fillable =
    [
        'id_forma',
        'id_serie',
        'numero',
        'factura_serie',
        'numero_dte',
        'fecha',
        'id_proveedor',
        'id_codigo',
        'id_libro',
        'numero_libro',
        'id_categoria_producto',
        'id_dependencia',
        'id_programa',
        'observaciones',
        'costo'
    ];

    public $timestamps = false;
}

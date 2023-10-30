<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EgresoDetalle extends Model
{
    use HasFactory;

    protected $table = 'detalle_pedido_despacho';

    protected $primaryKey = 'id_detalle_pedido_despacho';

    protected $fillable =
        [
            'id_pedido_despacho',
            'id_nombre_medicamento',
            'cantidad_solicitada',
            'cantidad_despachada',
            'precio'
        ];

    public $timestamps = false;
}

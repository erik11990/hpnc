<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Egresos extends Model
{
    use HasFactory;

    protected $table = 'pedido_despacho';

    protected $primaryKey = 'id_pedido_despacho';

    protected $fillable =
        [
            'pedido',
            'id_lugar',
            'fecha_pedido',
            'fecha_ingreso',
            'fecha_entrega',
            'id_entrega',
            'id_autoriza',
            'id_solicitante_paciente',
            'id_solicitante_colaborador',
            'id_categoria_producto',
            'total'
        ];

    public $timestamps = false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngresoDetalle extends Model
{
    use HasFactory;

    protected $table = "detalle_ingreso_bodega";

    protected $primaryKey = "id_detalle_ingreso_bodega";

    protected $fillable =
    [
        'id_ingreso_bodega',
        'id_nombre_producto',
        'id_accion_farmacologica',
        'id_laboratorio',
        'concentracion',
        'id_presentacion_unidad_de_medida',
        'id_marca',
        'lote',
        'fecha_vencimiento',
        'cantidad',
        'precio_unidad',
        'id_codigo_gasto_renglon',
        'orden_cp_y_p_numero',
        'folio_libro_inventario',
        'nomenclatura_de_cuentas',
        'folio_almacen',
    ];

    public $timestamps = false;
}

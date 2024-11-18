<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalles_venta extends Model
{
    use HasFactory;
    
    // Tabla asociada al modelo
    protected $table = 'detalles_ventas';

    // Llave primaria de la tabla
    // Método para indicar que la clave primaria es compuesta
    protected $primaryKey = ['cod_pro', 'venta_id'];
    // Desactivar la clave primaria autoincremental
    public $incrementing = false;

    // Deshabilita las marcas de tiempo si no usas `created_at` y `updated_at`
    public $timestamps = false;


    protected $fillable = [
        'cod_pro',
        'venta_id',
        'cantidad',
        // 'descuento',
    ];

    public function venta()
    {
        return $this->belongsTo(Venta::class, 'venta_id');
    }
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'cod_pro');
    }

    // public function devolucion() {
    //     return $this->hasOne(Devoluciones::class, ['cod_pro','venta_id']);
    // }
}

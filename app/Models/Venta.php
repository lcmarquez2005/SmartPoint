<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
        // Tabla asociada al modelo
    protected $table = 'ventas';

    // Llave primaria de la tabla
    protected $primaryKey = 'id';

    // Deshabilita las marcas de tiempo si no usas `created_at` y `updated_at`
    public $timestamps = false;

    protected $fillable = [
        'metodo_pago',
        'total',
        'fecha',
        'cliente_id',
        'usuario_id',
    ];
    protected $casts = [
        'fecha' => 'datetime',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
    public function detalles_ventas()
    {
        return $this->hasMany(Detalles_venta::class, 'venta_id');
    }
}

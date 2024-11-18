<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surtido extends Model
{
    use HasFactory;

        // Tabla asociada al modelo
    protected $table = 'surtidos';

    // Llave primaria de la tabla
    protected $primaryKey = 'id';

    // Deshabilita las marcas de tiempo si no usas `created_at` y `updated_at`
    public $timestamps = false;


    protected $fillable = [
        'metodo_pago',
        'total',
        'fecha',
        'proveedor_id',
        'usuario_id',
    ];



    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }
}

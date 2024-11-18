<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    // Tabla asociada al modelo
    protected $table = 'proveedores';

    // Llave primaria de la tabla
    protected $primaryKey = 'id';

    // Deshabilita las marcas de tiempo si no usas `created_at` y `updated_at`
    public $timestamps = false;

    // Campos que se pueden asignar de forma masiva
    protected $fillable = [
        'nombre',
        'telefono',
        'fecha_registro',
        'deuda',
        'calle',
        'numero',
        'colonia',
        'cod_postal',
        'ciudad',
        'estado',
        'pais',
    ];

    // Si quieres definir valores por defecto o métodos adicionales, hazlo aquí

    public function surtidos()
    {
        return $this->hasMany(Surtido::class, 'proveedor_id');
    }
}

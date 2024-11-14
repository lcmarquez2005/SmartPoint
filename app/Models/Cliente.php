<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    // Tabla asociada al modelo
    protected $table = 'clientes';

    // Llave primaria de la tabla
    protected $primaryKey = 'id';

    // Deshabilita las marcas de tiempo si no usas `created_at` y `updated_at`
    public $timestamps = false;

    // Campos que se pueden asignar de forma masiva
    protected $fillable = [
        'nombre',
        'apellido1',
        'apellido2',
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
}

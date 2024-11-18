<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    // Si el nombre de la tabla es diferente de la convención, especifica el nombre:
    protected $table = 'productos';
    
    protected $primaryKey = 'cod_pro'; // Define la clave primaria personalizada

    public $incrementing = false; // Define si la clave primaria es autoincremental o no

    protected $keyType = 'string'; // Define el tipo de la clave primaria si no es entero

    // Define los campos que se pueden asignar de forma masiva
    protected $fillable = ['cod_pro','nombre', 'cantidad', 'precio', 'st_minimos', 'st_maximos', 'piezas'];

    // Si no usas `created_at` y `updated_at`
    public $timestamps = false;


    public function detalles_ventas()
    {
        return $this->hasMany(Detalles_venta::class, 'cod_pro');
    }



}

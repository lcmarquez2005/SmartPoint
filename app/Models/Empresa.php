<?php

namespace App\Models;//definir que directorio esta (package)

use Illuminate\Database\Eloquent\Factories\HasFactory;//importaciones por defecto de laravel
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $table = 'empresas';//nombre de la tabla
    protected $fillable = ['nombre', 'telefono'];//atributos llenables

    public $timestamps = false;//! laravel genera por defecto atributos created-at,updated-at para todo model
                                // false porque no lo usaremos



    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'empresa_id');
    }
}

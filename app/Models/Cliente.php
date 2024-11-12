<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'clientes';// nombre de la tabla
    protected $fillable = ['nombre', 'apellido', 'rol', 'empresa_id'];


    // public function venta()
    // {
    //     return $this->hasMany(Venta::class, 'cliente_id');
    // }
}

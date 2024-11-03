<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $table = 'empresas';//nombre de la tabla
    protected $fillable = ['nombre', 'telefono'];

    public $timestamps = false;



    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'empresa_id');
    }
}

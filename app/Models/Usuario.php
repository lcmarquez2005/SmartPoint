<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;
    public $timestamps = false;
    protected $table = 'usuarios';// nombre de la tabla
    protected $fillable = ['username', 'password', 'rol', 'empresa_id'];

    protected $hidden = ['password', 'remember_token'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }
    public function surtidos()
    {
        return $this->hasMany(Surtido::class, 'usuario_id');
    }
    public function ventas()
    {
        return $this->hasMany(Venta::class, 'usuario_id');
    }
}

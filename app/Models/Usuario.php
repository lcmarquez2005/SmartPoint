<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';// nombre de la tabla
    protected $fillable = ['username', 'password', 'rol', 'empresa_id'];

    protected $hidden = ['password', 'remember_token'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPersona extends Model
{
    use HasFactory;

    protected $table = 'tipopersona';

    protected $primaryKey = 'ID';  // Definir la clave primaria correctamente


    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'TipoPersona');
    }
}

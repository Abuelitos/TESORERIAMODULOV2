<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'cliente';

    protected $primaryKey = 'dui';  // Definir la clave primaria correctamente

    public $incrementing = false;  // Indicar que la clave primaria no es autoincremental

    protected $keyType = 'string';  // Especificar que la clave primaria es una cadena

    protected $fillable = [
        'dui',
        'Nombres',
        'Apellidos',
        'Fecha_nacimiento',
        'Direccion',
        'Telefono',
        'Celular',
        'TipoPersonaId',
    ];

    public function notasAbono()
    {
        return $this->hasMany(NotaAbono::class, 'cliente');
    }

    public function tipoPersona()
    {
        return $this->belongsTo(TipoPersona::class, 'TipoPersonaId');
    }
}

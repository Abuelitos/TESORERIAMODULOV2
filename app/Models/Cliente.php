<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'cliente';

    protected $fillable = [
        'dui',
        'Nombres',
        'Apellidos',
        'Fecha_nacimiento',
        'Direccion',
        'Telefono',
        'Celular',
    ];

    protected $id = 'dui';

    public function notasAbono()
    {
        return $this->hasMany(NotaAbono::class, 'cliente', 'dui');
    }

    
}

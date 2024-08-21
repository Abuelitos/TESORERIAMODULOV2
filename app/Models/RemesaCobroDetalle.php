<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemesaCobroDetalle extends Model
{
    use HasFactory;

    protected $table = 'remesascobrodetalle';

    protected $fillable = [
        'FechaProcesamiento',
        'FechaCobro',
        'TipoCuentaColectora',
        'TipoCobro',
        'CorreoCliente',
        'ConceptoCobro',
        'MontoCobrar',
        'NombreAutoriza',
    ];

    // Relación inversa con RemesaCobro
    public function remesas()
    {
        return $this->hasMany(RemesasCobro::class, 'idremesascobrodetalle', 'ID');
    }
}

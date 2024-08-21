<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemesaPagoDetalle extends Model
{
    use HasFactory;

    protected $table = 'remesaspagodetalle';

    protected $fillable = [
        'FechaProcesamiento',
        'FechaPago',
        'TipoCuentaPagadora',
        'TipoPago',
        'CorreoBeneficiario',
        'ConceptoPago',
        'MontoPagar',
        'NombreAutoriza',
    ];

    // Relación inversa con RemesaPago
    public function remesas()
    {
        return $this->hasMany(RemesaPago::class, 'pagoDetalle', 'ID');
    }
}

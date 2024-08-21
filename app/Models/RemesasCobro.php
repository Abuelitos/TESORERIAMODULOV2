<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemesasCobro extends Model
{
    use HasFactory;

    protected $table = 'remesascobro';

    protected $fillable = [
        'bancoColector',
        'cuentaCliente',
        'idremesascobrodetalle',
    ];

    // Relación con RemesaCobroDetalle
    public function detalle()
    {
        return $this->belongsTo(RemesaCobroDetalle::class, 'idremesascobrodetalle', 'ID');
    }
}

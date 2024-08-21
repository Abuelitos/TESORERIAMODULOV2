<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemesaPago extends Model
{
    use HasFactory;

    protected $table = 'remesaspago';

    protected $fillable = [
        'bancoPagador',
        'cuentaCliente',
        'pagoDetalle',
    ];

    // Relación con RemesaPagoDetalle
    public function detalle()
    {
        return $this->belongsTo(RemesaPagoDetalle::class, 'pagoDetalle', 'ID');
    }
}

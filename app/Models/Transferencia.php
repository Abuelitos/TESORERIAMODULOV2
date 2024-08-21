<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transferencia extends Model
{
    use HasFactory;

    protected $table = 'transferencias';

    protected $fillable = [
        'Lugar',
        'FechaProcesamiento',
        'FechaEjecucion',
        'BancoOrigen',
        'CuentaBancoOrigen',
        'MontoNumeros',
        'MontosLetras',
        'BancoDestino',
        'NombreReceptor',
        'CuentaBancoReceptor',
        'MontoNumerosDestino',
        'MontosLetrasDestino',
        'TipoTransferencia',
        'ConceptoTransferencia',
        'CorreoReceptor',
        'TelefonoReceptor',
        'DireccionReceptor',
        'Pais',
        'ComisionesBancarias',
        'NombreAutoriza',
    ];

    // Relación con el banco origen
    public function bancoOrigen()
    {
        return $this->belongsTo(Banco::class, 'BancoOrigen', 'idbanco');
    }

    // Relación con el banco destino
    public function bancoDestino()
    {
        return $this->belongsTo(Banco::class, 'BancoDestino', 'idbanco');
    }
}

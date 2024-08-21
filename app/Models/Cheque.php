<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cheque extends Model
{
    use HasFactory;

    protected $fillable = [
        'Lugar', 
        'Fecha', 
        'BancoPagador', 
        'CuentaBancoPagador', 
        'MontoNumeros', 
        'MontosLetras', 
        'Firmas',
        'NumeroCheque'
    ];
    
    protected $table = 'cheques';
    protected $primaryKey = 'ID';

    public function banco()
    {
        return $this->belongsTo(Banco::class, 'BancoPagador', 'idbanco');
    }

}

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
        'Firmas'
    ];
    
    protected $guarded = [
        'ID'
    ];

    public function banco()
    {
        return $this->belongsTo(Banco::class, 'BancoPagador', 'ID');
    }

}

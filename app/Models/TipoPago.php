<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPago extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'Descripcion'
    ];

    protected $table = 'tipopago';

    protected $primaryKey = 'TipoPagoId';

    public $timestamps = false;

    public function Transferencia()
    {
        return $this->hasMany(Transferencia::class, 'TipoTransferencia', 'TipoPagoId');
    }
}

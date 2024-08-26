<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoTransferencia extends Model
{
    use HasFactory;


    protected $fillable = [
        'Nombre', 
        'Descripcion'
    ];

    protected $table = 'tipotransferencia';

    protected $primaryKey = 'ID';

    public $timestamps = false;

    public function NotaCargo()
    {
        return $this->hasMany(NotaCargo::class, 'FormaCobro', 'ID');
    }

    public function NotaAbono()
    {
        return $this->hasMany(NotaAbono::class, 'FormaAbono', 'ID');
    }
    
}

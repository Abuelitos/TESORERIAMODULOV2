<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaAbono extends Model
{
    use HasFactory;

    protected $fillable = [
        'Lugar', 
        'Fecha', 
        'cliente', 
        'ConceptoAbono', 
        'NumeroFactura', 
        'FormaAbono', 
        'Comentarios', 
        'NombreAutoriza'
    ];
    
    protected $table = 'notasabono'; 
    protected $primaryKey = 'ID';

    public $timestamps = false;

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente', 'dui');
    }
}

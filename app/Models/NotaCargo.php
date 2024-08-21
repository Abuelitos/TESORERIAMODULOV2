<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaCargo extends Model
{
    use HasFactory;

    protected $fillable = [
        'Lugar', 
        'Fecha', 
        'cliente_dui', 
        'ConceptoCargo', 
        'NumeroFactura', 
        'FormaCobro', 
        'Comentarios', 
        'NombreAutoriza'
    ];

    protected $table = 'notascargo'; // Asegúrate de que el nombre de la tabla sea correcto
    protected $primaryKey = 'ID';

    public $timestamps = false;

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_dui', 'dui');
    }
}

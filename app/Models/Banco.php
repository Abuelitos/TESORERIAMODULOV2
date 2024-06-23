<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    use HasFactory;

    protected $fillable = [
        'idbanco', 
        'nombre', 
        'activo'
    ];

    protected $table = 'banco';

    protected $primaryKey = 'idbanco';

    public function cheques()
    {
        return $this->hasMany(Cheque::class, 'BancoPagador', 'idbanco');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcesosListaDistribucion extends Model
{
    use HasFactory;

    protected $table = 'procesos_lista_distribucions';

    protected $fillable = [
        'modulo_id',
        'estatus',
    ];

    public function modulo()
    {
        return $this->belongsTo(ListaDistribucion::class, 'modulo_id', 'id');
    }
}

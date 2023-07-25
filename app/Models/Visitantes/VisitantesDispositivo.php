<?php

namespace App\Models\Visitantes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitantesDispositivo extends Model
{
    use HasFactory;

    protected $table = 'visitantes_dispositivos';

    protected $fillable = [
        'registrar_visitante_id',
        'dispositivo',
        'serie',
        'marca',
        'modelo',
    ];

    public function visitante()
    {
        return $this->belongsTo(RegistrarVisitante::class, 'registrar_visitante_id', 'id');
    }
}

<?php

namespace App\Models\Visitantes;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class VisitantesDispositivo extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
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

<?php

namespace App\Models\Visitantes;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VisitantesDispositivo extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

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

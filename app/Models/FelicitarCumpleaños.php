<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class FelicitarCumpleaños extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'felicitaciones_cumpleaños';

    protected $fillable = [
        'cumpleañero_id',
        'felicitador_id',
        'comentarios',
        'like',
    ];

    public function cumpleañero()
    {
        return $this->belongsTo(Empleado::class, 'cumpleañero_id')->alta();
    }

    public function felicitador()
    {
        return $this->belongsTo(Empleado::class, 'felicitador_id')->alta();
    }
}

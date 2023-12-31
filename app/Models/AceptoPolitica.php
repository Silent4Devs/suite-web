<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class AceptoPolitica extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory;

    public $table = 'acepto_politica';

    protected $fillable = [
        'id_empleado',
        'id_politica',
        'acepto',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function aceptador()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado')->alta();
    }

    public function politica()
    {
        return $this->belongsTo(PoliticaSgsi::class, 'id_politica');
    }
}

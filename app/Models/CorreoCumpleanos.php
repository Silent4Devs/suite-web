<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class CorreoCumpleanos extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory;

    public $table = 'correo_cumpleanos';

    public $timestamps = false;

    protected $fillable = [
        'empleado_id',
        'fecha_envio',
        'enviado',
        'created_at',
        'updated_at',
    ];
}

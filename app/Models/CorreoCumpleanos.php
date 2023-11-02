<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CorreoCumpleanos extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

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

<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class MiembrosComiteSeguridad extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory, SoftDeletes;

    public $table = 'miembros_comite_seguridad';

    public static $searchable = [
        'nombrerol',
    ];

    protected $dates = [
        'fechavigor',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nombrerol',
        'comite_id',
        'id_asignada',
        'fechavigor',
        'responsabilidades',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getFechaVigorAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d-m-Y') : null;
    }

    public function asignacion()
    {
        return $this->belongsTo(Empleado::class, 'id_asignada', 'id')->alta();
    }

    public function miembrosComite()
    {
        return $this->belongsTo(self::class, 'comite_id');
    }
}

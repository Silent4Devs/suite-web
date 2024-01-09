<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class PoliticaSgsi extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory, MultiTenantModelTrait, SoftDeletes;

    public $table = 'politica_sgsis';

    public static $searchable = [
        'politicasgsi',

    ];

    protected $dates = [
        'fecha_publicacion',
        'fecha_entrada',
        'fecha_revision',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nombre_politica',
        'politicasgsi',
        'fecha_publicacion',
        'fecha_entrada',
        'fecha_revision',
        'id_reviso_politica',
        'estatus',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    public static function getAll()
    {
        return Cache::remember('politicas_sgsi_all', 3600 * 12, function () {
            return self::with('reviso')->get();
        });
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getFechaPublicacionAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d-m-Y') : null;
    }

    public function getFechaEntradaAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d-m-Y') : null;
    }

    public function getFechaRevisionAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d-m-Y') : null;
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function reviso()
    {
        return $this->belongsTo(Empleado::class, 'id_reviso_politica', 'id')->alta();
    }

    public function revisobaja()
    {
        return $this->belongsTo(Empleado::class, 'id_reviso_politica', 'id');
    }
}

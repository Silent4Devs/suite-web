<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use App\Traits\ClearsResponseCache;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MiembrosComiteSeguridad extends Model implements Auditable
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

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
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function personaasignada()
    {
        return $this->belongsTo(User::class, 'personaasignada_id');
    }

    public function getFechaVigorAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d-m-Y') : null;
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
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

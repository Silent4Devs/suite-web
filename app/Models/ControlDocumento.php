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

class ControlDocumento extends Model implements Auditable
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    public $table = 'control_documentos';

    protected $dates = [
        'fecha_creacion',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'clave',
        'nombre',
        'fecha_creacion',
        'version',
        'elaboro_id',
        'reviso_id',
        'created_at',
        'estado_id',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function generateTwoFactorCode()
    {
        $this->timestamps = false;
        $this->two_factor_code = rand(100000, 999999);
        $this->two_factor_expires_at = now()->addMinutes(15)->format(config('panel.date_format') . ' ' . config('panel.time_format'));
        $this->save();
    }

    public function resetTwoFactorCode()
    {
        $this->timestamps = false;
        $this->two_factor_code = null;
        $this->two_factor_expires_at = null;
        $this->save();
    }

    public function getFechaCreacionAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFechaCreacionAttribute($value)
    {
        $this->attributes['fecha_creacion'] = $value ? Carbon::createFromFormat(config('panel.date_format'), Carbon::parse($value)->format('d-m-Y'))->format('Y-m-d') : null;
    }

    public function elaboro()
    {
        return $this->belongsTo(User::class, 'elaboro_id');
    }

    public function reviso()
    {
        return $this->belongsTo(User::class, 'reviso_id');
    }

    public function estado()
    {
        return $this->belongsTo(EstadoDocumento::class, 'estado_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}

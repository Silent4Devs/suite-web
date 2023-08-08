<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Riesgosoportunidade extends Model implements Auditable
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;
    use \OwenIt\Auditing\Auditable;

    public $table = 'riesgosoportunidades';

    const APLICAORGANIZACION_SELECT = [
        'Si' => 'Si',
        'No' => 'No',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'control_id',
        'aplicaorganizacion',
        'justificacion',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function control()
    {
        return $this->belongsTo(Controle::class, 'control_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}

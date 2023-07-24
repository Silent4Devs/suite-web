<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RevisionDireccion extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;
    public $table = 'revision_direccions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'estadorevisionesprevias',
        'cambiosinternosexternos',
        'retroalimentaciondesempeno',
        'retroalimentacionpartesinteresadas',
        'resultadosriesgos',
        'oportunidadesmejoracontinua',
        'acuerdoscambios',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}

<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanAuditorium extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;

    public $table = 'plan_auditoria';

    public static $searchable = [
        'objetivo',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'fecha_id',
        'objetivo',
        'alcance',
        'criterios',
        'documentoauditar',
        'equipoauditor',
        'descripcion',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function fecha()
    {
        return $this->belongsTo(AuditoriaAnual::class, 'fecha_id');
    }

    public function auditados()
    {
        return $this->belongsToMany(User::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}

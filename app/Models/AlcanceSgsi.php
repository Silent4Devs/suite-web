<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class AlcanceSgsi extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;

    public $table = 'alcance_sgsis';

    public static $searchable = [
        'alcancesgsi',
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
        'alcancesgsi',
        'fecha_publicacion',
        'fecha_entrada',
        'fecha_revision',
        'id_reviso_alcance',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

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

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_reviso_alcance', 'id')->with('area');
    }

}

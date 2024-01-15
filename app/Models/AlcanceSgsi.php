<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class AlcanceSgsi.
 *
 * @property int $id
 * @property string|null $alcancesgsi
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $team_id
 * @property Carbon|null $fecha_publicacion
 * @property Carbon|null $fecha_entrada
 * @property Carbon|null $fecha_revision
 * @property int|null $id_reviso_alcance
 * @property int|null $norma_id
 * @property Team|null $team
 * @property Empleado|null $empleado
 * @property Norma|null $norma
 */
class AlcanceSgsi extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory, SoftDeletes;

    public $table = 'alcance_sgsis';

    public static $searchable = [
        'alcancesgsi',
    ];

    protected $casts = [
        'id_reviso_alcance' => 'int',
    ];

    protected $dates = [
        'fecha_publicacion',
        'fecha_entrada',
        'fecha_revision',
    ];

    protected $fillable = [
        'nombre',
        'alcancesgsi',
        'team_id',
        'fecha_publicacion',
        'fecha_entrada',
        'fecha_revision',
        'id_reviso_alcance',
        'norma_id',
        'estatus',
    ];

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
        return $this->belongsTo(Team::class);
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_reviso_alcance')->alta()->with('area')->select('id', 'name', 'email', 'area_id');
    }

    public function norma()
    {
        return $this->belongsTo(Norma::class);
    }

    public function normas()
    {
        return $this->belongsToMany(Norma::class, 'normas_alcance_sgsi', 'alcance_id', 'norma_id');
    }
}

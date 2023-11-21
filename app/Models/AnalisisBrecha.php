<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class AnalisisBrecha.
 *
 * @property int $id
 * @property character varying $nombre
 * @property Carbon $fecha
 * @property character varying $porcentaje_implementacion
 * @property int|null $id_elaboro
 * @property int $estatus
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property string|null $deleted_at
 * @property Empleado|null $empleado
 * @property Collection|GapLogroTre[] $gap_logro_tres
 * @property Collection|GapLogroDo[] $gap_logro_dos
 * @property Collection|GapLogroUno[] $gap_logro_unos
 */
class AnalisisBrecha extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'analisis_brechas';

    protected $casts = [
        'nombre' => 'string',
        'porcentaje_implementacion' => 'string',
        'id_elaboro' => 'int',
        'estatus' => 'int',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
    ];

    protected $dates = [
        'fecha',
    ];

    protected $fillable = [
        'nombre',
        'fecha',
        'porcentaje_implementacion',
        'id_elaboro',
        'estatus',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_elaboro')->alta();
    }

    public function gap_logro_tres()
    {
        return $this->hasMany(GapTre::class, 'analisis_brechas_id');
    }

    public function gap_logro_dos()
    {
        return $this->hasMany(GapDo::class, 'analisis_brechas_id');
    }

    public function gap_logro_unos()
    {
        return $this->hasMany(GapUno::class, 'analisis_brechas_id');
    }
}

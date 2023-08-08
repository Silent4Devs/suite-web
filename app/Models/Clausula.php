<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Clausula.
 *
 * @property int $id
 * @property character varying $nombre
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property string|null $deleted_at
 * @property character varying|null $modulo
 * @property Collection|AuditoriaInternoClausula[] $auditoria_interno_clausulas
 * @property Collection|PartesInteresada[] $partes_interesadas
 */
class Clausula extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'clausulas';

    protected $casts = [
        'nombre' => 'string',
        'modulo' => 'string',
    ];

    protected $fillable = [
        'nombre',
        'modulo',
    ];

    public function auditoria_interno_clausulas()
    {
        return $this->hasMany(AuditoriaInternoClausula::class);
    }

    public function partes_interesadas()
    {
        return $this->belongsToMany(PartesInteresada::class, 'partes_interesadas_clausula', 'clausula_id', 'partesint_id')
            ->withPivot('id')
            ->withTimestamps();
    }
}

<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class MatrizOctaveServicio.
 *
 * @property int $id
 * @property string|null $servicio
 * @property string|null $descripcion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Collection|MatrizOctaveProceso[] $matriz_octave_procesos
 */
class MatrizOctaveServicio extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $table = 'matriz_octave_servicios';

    protected $fillable = [
        'servicio',
        'descripcion',
    ];

    public function matriz_octave_procesos()
    {
        return $this->hasMany(MatrizOctaveProceso::class, 'servicio_id');
    }
}

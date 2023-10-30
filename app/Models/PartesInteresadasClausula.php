<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class PartesInteresadasClausula.
 *
 * @property int $id
 * @property int $clausula_id
 * @property int $partesint_id
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property Clausula $clausula
 * @property PartesInteresada $partes_interesada
 */
class PartesInteresadasClausula extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $table = 'partes_interesadas_clausula';

    protected $casts = [
        'clausula_id' => 'int',
        'partesint_id' => 'int',
    ];

    protected $fillable = [
        'clausula_id',
        'partesint_id',
    ];

    public function clausula()
    {
        return $this->belongsTo(Clausula::class);
    }

    public function partes_interesada()
    {
        return $this->belongsTo(PartesInteresada::class, 'partesint_id');
    }
}

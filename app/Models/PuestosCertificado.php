<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class PuestosCertificado.
 *
 * @property int $id
 * @property character varying|null $requisito
 * @property character varying|null $nombre
 * @property int|null $puesto_id
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property Puesto|null $puesto
 */
class PuestosCertificado extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'puestos_certificados';

    protected $fillable = [
        'requisito',
        'nombre',
        'puesto_id',
    ];

    public function puesto()
    {
        return $this->belongsTo(Puesto::class);
    }
}

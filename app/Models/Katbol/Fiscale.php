<?php

namespace App\Models\Katbol;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class Fiscale extends Model implements Auditable
{
    use AuditableTrait;

    protected $table = 'fiscales';

    protected $casts = [
        'persona_fiscal' => 'string',

    ];

    protected $fillable = [
        'persona_fiscal',
        // 'id_fiscale',

    ];

    public function proveedores()
    {
        return $this->hasMany(Proveedores::class, 'id_fiscale');
    }
}

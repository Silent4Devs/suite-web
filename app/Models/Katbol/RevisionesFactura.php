<?php

namespace App\Models\Katbol;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class RevisionesFactura extends Model implements Auditable
{
    use HasFactory, softDeletes;
    use AuditableTrait;

    public $table = 'revisiones_facturas';

    protected $dates = ['deleted_at'];

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $fillable = [

        'no_revisiones',
        'cumple',
        'observaciones',
        'estatus',
        'id_facturacion',
        'asignado_id',
    ];

    public function asignado()
    {
        return $this->belongsTo(User::class, 'asignado_id');
    }
}
